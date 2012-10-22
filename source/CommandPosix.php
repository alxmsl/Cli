<?php

namespace Cli;

/**
 * Class for POSIX command line support
 * @author alxmsl
 * @date 10/22/12
 */
final class CommandPosix extends Command {
    /**
     * @var array cache of added parameters
     */
    private $searchStringsCache = array();

    /**
     * Method to build getopt parameter postfix for option
     * @param Option $Option instance of option
     * @return string getopt parameter postfix for option
     */
    private static function getPostfix(Option $Option) {
        $postfix = '';
        if ($Option->getType() == Option::TYPE_STRING) {
            $postfix .= ':';
            if ($Option->isRequired()) {
                $postfix .= ':';
            }
        }
        return $postfix;
    }

    /**
     * Method to get getopt parameters for command line parsing
     * @return array getopt parameters
     */
    private function getOptionsSearchStrings() {
        if (empty($this->searchStringsCache)) {
            $this->searchStringsCache = array(
                0 => '',
                1 => array(),
            );
            foreach ($this->parameters as $Option) {
                $postfix = self::getPostfix($Option);
                /** @var $Option Option */
                $this->searchStringsCache[0] .= $Option->getShort() . $postfix;
                $this->searchStringsCache[1][] = $Option->getLong() . $postfix;
            }
        }
        return $this->searchStringsCache;
    }

    /**
     * Method to clear getopt parameters cache
     */
    protected function clearCache() {
        $this->searchStringsCache = array();
    }

    /**
     * POSIX parse command line method
     */
    public function parse() {
        list($shorts, $longs) = $this->getOptionsSearchStrings();
        $options = getopt($shorts, $longs);
        foreach ($this->parameters as $Option) {
            /** @var $Option Option */
            $short = $Option->getShort();
            $long = $Option->getLong();
            switch (true) {
                case isset($options[$short]) && isset($options[$long]):
                    throw new DuplicateOptionException();
                case isset($options[$short]):
                    $this->setOptionValue($Option, $options[$short]);
                    break;
                case isset($options[$long]):
                    $this->setOptionValue($Option, $options[$long]);
                    break;
                case $Option->isRequired():
                    throw new RequiredOptionException();
            }
        }
    }

    /**
     * Display command help
     */
    public function displayHelp() {
        $string = 'Using: ' . $this->script . ' ' . $this->command . ' ';
        $where = array();
        foreach ($this->parameters as $Option) {
            /** @var $Option Option */
            $short = $Option->getShort();
            $long = $Option->getLong();
            $temp = '-' . $short . '|--' . $long;
            if (!$Option->isRequired()) {
                $string .= '[' . $temp . '] ';
            } else {
                $string .= $temp . ' ';
            }

            $where[] = '-' . $short . ', --' . $long . '  - ' . $Option->getDescription() . "\n";
        }
        $string .= "\n";
        $string .= implode("\n", $where);
        echo $string;
    }

    /**
     * Method to set option value and call event handler if needed
     * @param Option $Option instance of option
     * @param bool|string $value option value
     */
    private function setOptionValue(Option $Option, $value) {
        $Option->setValue($value);
        $long = $Option->getLong();
        if (isset($this->events[$long])) {
            $Handler = $this->events[$long];
            $Handler($value);
        }
    }
}
