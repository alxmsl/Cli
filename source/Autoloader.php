<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\Cli;

// append Cli autoloader
spl_autoload_register(array('alxmsl\Cli\Autoloader', 'autoload'));

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
        'alxmsl\\Cli\\Autoloader'   => 'Autoloader.php',
        'alxmsl\\Cli\\Command'      => 'Command.php',
        'alxmsl\\Cli\\CommandPosix' => 'CommandPosix.php',
        'alxmsl\\Cli\\HelpOption'   => 'HelpOption.php',
        'alxmsl\\Cli\\Option'       => 'Option.php',
        'alxmsl\\Cli\\Parameter'    => 'Parameter.php',
        'alxmsl\\Cli\\Exception\\RequiredOptionException'              => 'Exception/RequiredOptionException.php',
        'alxmsl\\Cli\\Exception\\DuplicateOptionException'             => 'Exception/DuplicateOptionException.php',
        'alxmsl\\Cli\\Exception\\CliCallException'                     => 'Exception/CliCallException.php',
        'alxmsl\\Cli\\Exception\\ParameterEventTypeException'          => 'Exception/ParameterEventTypeException.php',
        'alxmsl\\Cli\\Exception\\ParameterNotFoundException'           => 'Exception/ParameterNotFoundException.php',
        'alxmsl\\Cli\\Exception\\IncorrectParameterValueTypeException' => 'Exception/IncorrectParameterValueTypeException.php',
        'alxmsl\\Cli\\Exception\\UnsupportedParameterTypeException'    => 'Exception/UnsupportedParameterTypeException.php',
        'alxmsl\\Cli\\Exception\\IncorrectEnvironmentException'        => 'Exception/IncorrectEnvironmentException.php',
        'alxmsl\\Cli\\Exception\\IncorrectSAPIException'               => 'Exception/IncorrectSAPIException.php',
        'alxmsl\\Cli\\Exception\\CliLogicException'                    => 'Exception/CliLogicException.php',
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