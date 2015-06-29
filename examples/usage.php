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
 *
 * Usage example
 * @author alxmsl
 * @date 10/22/12
 */

// Firstly include base class
include('../source/Autoloader.php');

use alxmsl\Cli\CommandPosix;
use alxmsl\Cli\Option;

// Create command instance
$Command = new CommandPosix();

// Append created option for help to command
$Command->appendHelpParameter('show help screen option');

// Append one required option. And...
$Command->appendParameter(new Option('option', 'o', 'some option', Option::TYPE_BOOLEAN, true));

// ...just parse the command
$Command->parse();

// If will exception, when required option is not set - use string below
//$Command->parse(true);
