<?php
/*
 * Copyright 2015 Alexey Maslov <alexey.y.maslov@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace alxmsl\Cli;

use alxmsl\Cli\Exception\IncorrectParameterValueTypeException;
use UnexpectedValueException;

/**
 * POSIX option class
 * @author alxmsl
 * @date 10/22/12
 */
class Option extends Parameter {
    /**
     * Available option types
     */
    const TYPE_BOOLEAN    = 0,
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
     * @param string $short short name of option
     * @param string $description description of option. Default value is empty
     * @param int $type option value type. Default value is boolean
     * @param bool $required option requirements. Default value is false
     * @throws UnexpectedValueException if value name is empty
     */
    public function __construct($long, $short, $description = '', $type = self::TYPE_BOOLEAN, $required = false) {
        parent::__construct($description, $required);
        $this->long = (string) $long;
        if (empty($this->long)) {
            throw new UnexpectedValueException('long option name must be not empty');
        }

        $this->short = substr($short, 0, 1);
        if (empty($this->short)) {
            throw new UnexpectedValueException('short option name must be not empty');
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
                throw new IncorrectParameterValueTypeException('option type must be bool or string');
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
