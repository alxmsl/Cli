Cli
=============
This is simple set of classes for support php-cli scripts

Usage example
-------
    // Firstly include base class
    include('../source/Cli.php');

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

