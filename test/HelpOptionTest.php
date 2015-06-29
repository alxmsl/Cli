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

use alxmsl\Cli\HelpOption;
use alxmsl\Cli\Option;
use PHPUnit_Framework_TestCase;

/**
 * Help option class tests
 * @author alxmsl
 */
final class HelpOptionTest extends PHPUnit_Framework_TestCase {
    public function testConstruction() {
        $Option1 = new HelpOption();
        $this->assertEquals('help', $Option1->getLong());
        $this->assertEquals('h', $Option1->getShort());
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option1->getType());
        $this->assertEmpty($Option1->getDescription());
        $this->assertFalse($Option1->isRequired());
        $this->assertFalse($Option1->hasValue());

        $Option2 = new HelpOption('help option description');
        $this->assertEquals('help', $Option2->getLong());
        $this->assertEquals('h', $Option2->getShort());
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option2->getType());
        $this->assertEquals('help option description', $Option2->getDescription());
        $this->assertFalse($Option2->isRequired());
        $this->assertFalse($Option2->hasValue());
    }

    public function testValue() {
        $Option = new HelpOption();
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option->getType());
        $this->assertFalse($Option->hasValue());

        $Option->setValue(123);
        $this->assertTrue($Option->hasValue());
        $this->assertTrue($Option->getValue());

        $Option->setValue('123');
        $this->assertTrue($Option->hasValue());
        $this->assertTrue($Option->getValue());

        $Option->setValue(123.54);
        $this->assertTrue($Option->hasValue());
        $this->assertTrue($Option->getValue());

        $Option->setValue(0);
        $this->assertTrue($Option->hasValue());
        $this->assertFalse($Option->getValue());

        $Option->setValue('');
        $this->assertTrue($Option->hasValue());
        $this->assertFalse($Option->getValue());

        $Option->setValue(null);
        $this->assertTrue($Option->hasValue());
        $this->assertFalse($Option->getValue());

        $Option->setValue(false);
        $this->assertTrue($Option->hasValue());
        $this->assertFalse($Option->getValue());

        $Option->setValue(true);
        $this->assertTrue($Option->hasValue());
        $this->assertTrue($Option->getValue());
    }
}
