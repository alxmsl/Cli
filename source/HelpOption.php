<?php

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
