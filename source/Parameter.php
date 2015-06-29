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
