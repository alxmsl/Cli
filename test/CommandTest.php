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

namespace alxmsl\Test\Cli;

use alxmsl\Cli\Command;
use alxmsl\Cli\Exception\IncorrectSAPIException;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * Command class tests
 * @author alxmsl
 */
final class CommandTest extends PHPUnit_Framework_TestCase {
    public function testIncorrectSAPI() {
        $Mock = $this->getMockBuilder(Command::class)
            ->setMethods(['isCLI'])
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $Mock->expects($this->once())->method('isCLI')->will($this->returnValue(false));

        $Class       = new ReflectionClass($Mock);
        $Constructor = $Class->getConstructor();
        try {
            $Constructor->invoke($Mock);
            $this->fail();
        } catch (IncorrectSAPIException $Ex) {}
    }
}
