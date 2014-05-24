<?php
/**
 * Usage example with composer
 * Make composer install first
 * @author alxmsl
 * @date 5/24/14
 */

include '../vendor/autoload.php';

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
