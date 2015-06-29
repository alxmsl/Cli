<?php
/*
 * Copyright 2015 Alexey Maslov <alexey.y.maslov@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
     * @param string $className class name
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
