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

// Just create command line option instances
$OptionHelp = new \Cli\Option('help', 'h', 'show help screen option');

// Create command instance
$Command = new \Cli\CommandPosix();

// Append created option instances to command. Define option handlers, if needed. And...
$Command->appendParameter($OptionHelp, function() use ($Command) {
    $Command->displayHelp();
});

// ...just parse the command
$Command->parse();