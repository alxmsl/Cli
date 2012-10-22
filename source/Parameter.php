<?php

namespace Cli;

/**
 * Abstract command line parameter class
 * @author alxmsl
 * @date 10/22/12
 */
abstract class Parameter {
    /**
     * @var string description of parameter
     */
    private $description = '';

    /**
     * @var bool requirements data of parameter
     */
    private $required = false;

    /**
     * @param string $description description of parameter
     * @param bool $required requirements data of parameter
     */
    public function __construct($description, $required) {
        $this->description = (string) $description;
        $this->required = (bool) $required;
    }

    /**
     * Description getter
     * @return string description of parameter
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Requirements getter
     * @return bool requirements of parameter
     */
    public function isRequired() {
        return $this->required;
    }
}
