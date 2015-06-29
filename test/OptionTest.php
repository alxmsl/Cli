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

use alxmsl\Cli\Exception\IncorrectParameterValueTypeException;
use alxmsl\Cli\Option;
use PHPUnit_Framework_TestCase;
use UnexpectedValueException;

/**
 * Option class tests
 * @author alxmsl
 */
final class OptionTest extends PHPUnit_Framework_TestCase {
    public function testEmptyConstruction() {
        try {
            new Option('', '');
            $this->fail();
        } catch (UnexpectedValueException $Ex) {}

        try {
            new Option('name', '');
            $this->fail();
        } catch (UnexpectedValueException $Ex) {}

        try {
            new Option('', 'name');
            $this->fail();
        } catch (UnexpectedValueException $Ex) {}

        try {
            new Option('', 'n');
            $this->fail();
        } catch (UnexpectedValueException $Ex) {}
    }

    public function testUnknownTypeConstruction() {
        try {
            new Option('name', 'n', '', -1);
            $this->fail();
        } catch (IncorrectParameterValueTypeException $Ex) {}

        try {
            new Option('name', 'n', '', 2);
            $this->fail();
        } catch (IncorrectParameterValueTypeException $Ex) {}

        new Option('name', 'n', '', '1aaa');

        try {
            new Option('name', 'n', '', '87aaa');
            $this->fail();
        } catch (IncorrectParameterValueTypeException $Ex) {}
    }
    
    public function testConstruction() {
        $Option1 = new Option('name', 'name');
        $this->assertEquals('name', $Option1->getLong());
        $this->assertEquals('n', $Option1->getShort());
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option1->getType());
        $this->assertEmpty($Option1->getDescription());
        $this->assertFalse($Option1->isRequired());
        $this->assertFalse($Option1->hasValue());

        $Option2 = new Option('another', 'o');
        $this->assertEquals('another', $Option2->getLong());
        $this->assertEquals('o', $Option2->getShort());
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option2->getType());
        $this->assertEmpty($Option2->getDescription());
        $this->assertFalse($Option2->isRequired());
        $this->assertFalse($Option2->hasValue());

        $Option3 = new Option('another', 'o', 'my description');
        $this->assertEquals('another', $Option3->getLong());
        $this->assertEquals('o', $Option3->getShort());
        $this->assertEquals(Option::TYPE_BOOLEAN, $Option3->getType());
        $this->assertEquals('my description', $Option3->getDescription());
        $this->assertFalse($Option3->isRequired());
        $this->assertFalse($Option3->hasValue());

        $Option4 = new Option('another', 'o', 'my description', Option::TYPE_STRING);
        $this->assertEquals('another', $Option4->getLong());
        $this->assertEquals('o', $Option4->getShort());
        $this->assertEquals(Option::TYPE_STRING, $Option4->getType());
        $this->assertEquals('my description', $Option4->getDescription());
        $this->assertFalse($Option4->isRequired());
        $this->assertFalse($Option4->hasValue());

        $Option5 = new Option('another', 'o', 'my description', Option::TYPE_STRING, true);
        $this->assertEquals('another', $Option5->getLong());
        $this->assertEquals('o', $Option5->getShort());
        $this->assertEquals(Option::TYPE_STRING, $Option5->getType());
        $this->assertEquals('my description', $Option5->getDescription());
        $this->assertTrue($Option5->isRequired());
        $this->assertFalse($Option5->hasValue());
    }

    public function testStringValue() {
        $Option = new Option('another', 'o', '', Option::TYPE_STRING);
        $this->assertEquals(Option::TYPE_STRING, $Option->getType());
        $this->assertFalse($Option->hasValue());

        $Option->setValue(123);
        $this->assertTrue($Option->hasValue());
        $this->assertSame('123', $Option->getValue());

        $Option->setValue('123');
        $this->assertTrue($Option->hasValue());
        $this->assertSame('123', $Option->getValue());

        $Option->setValue(123.54);
        $this->assertTrue($Option->hasValue());
        $this->assertSame('123.54', $Option->getValue());

        $Option->setValue(.54);
        $this->assertTrue($Option->hasValue());
        $this->assertSame('0.54', $Option->getValue());

        $Option->setValue(null);
        $this->assertTrue($Option->hasValue());
        $this->assertSame('', $Option->getValue());

        $Option->setValue(false);
        $this->assertTrue($Option->hasValue());
        $this->assertSame('', $Option->getValue());

        $Option->setValue('some value string');
        $this->assertTrue($Option->hasValue());
        $this->assertSame('some value string', $Option->getValue());
    }

    public function testBooleanValue() {
        $Option = new Option('another', 'o', '', Option::TYPE_BOOLEAN);
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
