<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
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
