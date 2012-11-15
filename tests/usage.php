<?php
/**
 * Usage example
 * @author alxmsl
 * @date 10/22/12
 */

// Firstly include base class
include('../source/Autoloader.php');

use \Cli\CommandPosix,
    \Cli\Option;

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
