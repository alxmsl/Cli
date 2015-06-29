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

use alxmsl\Cli\Exception\IncorrectEnvironmentException;
use alxmsl\Cli\Exception\IncorrectSAPIException;
use alxmsl\Cli\Exception\ParameterEventTypeException;
use alxmsl\Cli\Exception\ParameterNotFoundException;
use alxmsl\Cli\Exception\UnsupportedParameterTypeException;
use Closure;

/**
 * Abstract command class
 * @author alxmsl
 * @date 10/22/12
 */
abstract class Command {
    /**
     * @var string run script name
     */
    protected $script = '';

    /**
     * @var string run command name
     */
    protected $command = '';

    /**
     * @var array command parameters
     */
    protected $parameters = array();

    /**
     * @var array parameters events
     */
    protected $events = array();

    /**
     * @throws IncorrectSAPIException when PHP SAPI is not CLI
     * @throws IncorrectEnvironmentException when script name was not find
     */
    public function __construct() {
        switch (true) {
            case !$this->isCLI():
                throw new IncorrectSAPIException('current SAPI is not CLI');
            case array_key_exists('_', $_SERVER) && !is_null($_SERVER['_']):
                $this->script = $_SERVER['_'];
                $this->command = $_SERVER['argv'][0];
                break;
            case array_key_exists('SCRIPT_NAME', $_SERVER):
                $this->command = $_SERVER['SCRIPT_NAME'];
                break;
            default:
                throw new IncorrectEnvironmentException('incorrect command initialization');
        }
    }

    /**
     * Append parameter method
     * @param Parameter $Parameter adding parameter instance
     * @param null|\Closure $Handler closure function if parameter will be define. If NULL - event will not activated
     * @throws ParameterEventTypeException exception if $Closure have not \Closure type
     * @throws UnsupportedParameterTypeException if $Parameter instance has unsupported type
     */
    public function appendParameter(Parameter $Parameter, $Handler = null) {
        /** @var $Parameter Option */
        switch (true) {
            case $Parameter instanceof Option:
                $this->parameters[$Parameter->getLong()] = $Parameter;
                if (!is_null($Handler)) {
                    if ($Handler instanceof Closure) {
                        $this->setEvent($Parameter, $Handler);
                    } else {
                        throw new ParameterEventTypeException();
                    }
                }
                $this->clearCache();
                break;
            default:
                throw new UnsupportedParameterTypeException();
        }
    }

    /**
     * Append help parameter
     * @param string $description description of option. Default value is empty
     */
    public function appendHelpParameter($description) {
        $Option = new HelpOption($description);
        $Self = $this;
        $this->appendParameter($Option, function() use ($Self) {
            $Self->displayHelp();
        });
    }

    /**
     * Set event for added parameter
     * @param Parameter $Parameter adding parameter instance
     * @param Closure $Handler closure function if parameter will be define
     * @throws ParameterNotFoundException if $Parameter instance is not added to command
     * @throws UnsupportedParameterTypeException if $Parameter instance has unsupported type
     */
    public function setEvent(Parameter $Parameter, Closure $Handler) {
        /** @var $Parameter Option */
        switch (true) {
            case $Parameter instanceof Option:
                $long = $Parameter->getLong();
                if (isset($this->parameters[$long])) {
                    $this->events[$long] = $Handler;
                } else {
                    throw new ParameterNotFoundException();
                }
                break;
            default:
                throw new UnsupportedParameterTypeException();
        }
    }

    /**
     * @return bool true, if current SAPI is CLI
     */
    public function isCLI() {
        return PHP_SAPI == 'cli';
    }

    /**
     * Abstract parse command line method
     */
    abstract public function parse();

    /**
     * Abstract cache support function
     */
    abstract protected function clearCache();

    /**
     * Display command help
     */
    abstract public function displayHelp();
}
