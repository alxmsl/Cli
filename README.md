Cli
=============
This is simple set of classes for support php-cli script options

Posibilities
-------
You can set short or long option name, while call php-cli script. The same lines may be equal

    php script.php -a               # short name of option apply
    php script.php --apply

You can use boolean or string option values

    php script.php --apply          # option 'apply' has boolean value
    php script.php --change=all -a  # option 'change' has string value 'all', and option 'aplly' has boolean value true
    php script.php --change=all     # option 'aplly' has boolean value false. It's not set

You can create required options or not

    php script.php -s Test          # option 'script' is required

...if you call 'script.php' without 's' option, you will see

    php script.php
    PHP Fatal error:  Uncaught exception 'Cli\RequiredOptionException' in /root/CommandPosix.php:79

On each option you can add callback (see Usage Example). Callback function can use first parameter as an option name, second as value

    $Command->appendParameter($Option, function($name, $value) {
        echo 'option \'' . $name . '\' value is \'' . $value . '\'' . "\n";
    });

you will see

    php script.php --script=noscript
    option 'script' value is 'noscript'

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

