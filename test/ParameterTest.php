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

use alxmsl\Cli\Parameter;
use PHPUnit_Framework_TestCase;

/**
 * Parameter tests class
 * @author alxmsl
 */
final class ParameterTest extends PHPUnit_Framework_TestCase {
    public function test() {
        /** @var Parameter $Mock1 */
        $Mock1 = $this->getMockForAbstractClass(Parameter::class, [
            'some description',
            true,
        ]);
        $this->assertEquals('some description', $Mock1->getDescription());
        $this->assertTrue($Mock1->isRequired());

        /** @var Parameter $Mock2 */
        $Mock2 = $this->getMockForAbstractClass(Parameter::class, [
            123456789,
            false,
        ]);
        $this->assertSame('123456789', $Mock2->getDescription());
        $this->assertFalse($Mock2->isRequired());
    }
}
