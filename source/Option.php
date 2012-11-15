<?php

namespace Cli;

/**
 * POSIX option class
 * @author alxmsl
 * @date 10/22/12
 */
class Option extends Parameter {
    /**
     * Available option types
     */
    const   TYPE_BOOLEAN    = 0,
            TYPE_STRING     = 1;

    /**
     * @var string long name of option
     */
    private $long = '';

    /**
     * @var string short name of option
     */
    private $short = '';

    /**
     * @var null|bool|string value of option
     */
    private $value = null;

    /**
     * @var int option value type
     */
    private $type = self::TYPE_BOOLEAN;

    /**
     * @param string $long long name of option
     * @param bool $short short name of option
     * @param string $description description of option. Default value is empty
     * @param int $type option value type. Default value is boolean
     * @param bool $required option requirements. Default value is false
     */
    public function __construct($long, $short, $description = '', $type = self::TYPE_BOOLEAN, $required = false) {
        parent::__construct($description, $required);
        $this->long = (string) $long;
        if (empty($this->long)) {
            throw new \UnexpectedValueException();
        }

        $this->short = substr($short, 0, 1);
        if (empty($this->short)) {
            throw new \UnexpectedValueException();
        }

        $this->type = (int) $type;
        $this->checkType($type);
    }

    /**
     * Check availability of option type
     * @param int $type option type constant value
     * @throws IncorrectParameterValueTypeException throws if option has unsupported value type
     */
    private function checkType($type) {
        switch ($type) {
            case self::TYPE_BOOLEAN:
            case self::TYPE_STRING:
                break;
            default:
                throw new IncorrectParameterValueTypeException();
        }
    }

    /**
     * Long name getter
     * @return string long name of the option
     */
    public function getLong() {
        return $this->long;
    }

    /**
     * Short name getter
     * @return string short name of the option
     */
    public function getShort() {
        return $this->short;
    }

    /**
     * Option type getter
     * @return int constant of type of the option
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Option value setter
     * @param string|bool $value option value
     * @return Option self
     */
    public function setValue($value) {
        switch ($this->type) {
            case self::TYPE_BOOLEAN:
                $this->value = (bool) $value;
                break;
            case self::TYPE_STRING:
                $this->value = (string) $value;
                break;
        }
        return $this;
    }

    /**
     * Option value getter
     * @return bool|null|string current option value
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Method to check option value ability
     * @return bool if true, option value is defined, else false
     */
    public function hasValue() {
        return !is_null($this->value);
    }
}
