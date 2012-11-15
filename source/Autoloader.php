<?php

namespace Cli;

// append Cli autoloader
spl_autoload_register(array('\Cli\Autoloader', 'autoload'));

/**
 * Base class
 * @author alxmsl
 * @date 10/22/12
 */
final class Autoloader {
    /**
     * @var array array of available classes
     */
    private static $classes = array(
        'Cli\\Autoloader'   => 'Autoloader.php',
        'Cli\\Command'      => 'Command.php',
        'Cli\\CommandPosix' => 'CommandPosix.php',
        'Cli\\Option'       => 'Option.php',
        'Cli\\Parameter'    => 'Parameter.php',
    );

    /**
     * Component autoloader
     * @param string $className claass name
     */
    public static function autoload($className) {
        if (array_key_exists($className, self::$classes)) {
            $fileName = realpath(dirname(__FILE__)) . '/' . self::$classes[$className];
            if (file_exists($fileName)) {
                include $fileName;
            }
        }
    }
}