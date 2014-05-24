Cli
=============
This is simple set of classes for support php-cli script options

Advantages
-------
1. Lightweight - only two classes for work with command options
2. Events helps to up your code flexibility
3. Self-autoloading. You need to include only one file
4. Independed namespace helps to use Cli on different projects and frameworks

Posibilities
-------
You can set short or long option name, while call php-cli script. The same lines may be equal

    php script.php -a               # short name of option apply
    php script.php --apply

You can use boolean or string option values

    php script.php --apply          # option 'apply' has boolean value
    php script.php --change=all -a  # option 'change' has string value 'all', and option 'aplly' has boolean value true
    php script.php --change=all     # option 'aplly' has boolean value false. It's not set

If you use string values, that containing spaces, quote its

    php script.php --change="all the world"

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
    $OptionHelp = new Option('help', 'h', 'show help screen option');

    // Create command instance
    $Command = new CommandPosix();

    // Append created option for help to command
    $Command->appendHelpParameter('show help screen option');

    // Append one required option. And...
    $Command->appendParameter(new Option('option', 'o', 'some option', Option::TYPE_BOOLEAN, true));

    // ...just parse the command
    $Command->parse();

If you will need the exception when required options value will not set, try:

    $Command->parse(true);

You will see something like this:

    alxmsl:~/cli/tests$ php usage.php
    PHP Fatal error:  Uncaught exception 'Cli\RequiredOptionException' with message 'option' in /home/alxmsl/cli/source/CommandPosix.php:92
    Stack trace:
    #0 /home/alxmsl/cli/tests/usage.php(27): Cli\CommandPosix->parse(true)
    #1 {main}
      thrown in /home/alxmsl/sources/cli/CommandPosix.php on line 92

License
-------
Copyright © 2014 Alexey Maslov <alexey.y.maslov@gmail.com>
This work is free. You can redistribute it and/or modify it under the
terms of the Do What The Fuck You Want To Public License, Version 2,
as published by Sam Hocevar. See the COPYING file for more details.