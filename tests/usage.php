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

// Append created option for help to command. And...
$Command->appendHelpParameter('show help screen option');

// ...just parse the command
$Command->parse();