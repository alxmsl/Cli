<?php
/*
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace alxmsl\Cli;

/**
 * Help option class
 * @author alxmsl
 * @date 11/15/12
 */
final class HelpOption extends Option {
    /**
     * Long and short option names
     */
    const NAME_LONG   = 'help',
          NAME_SHORT  = 'h';

    /**
     * @param string $description description of option. Default value is empty
     */
    public function __construct($description = '') {
        parent::__construct('help', 'h', $description);
    }
}
