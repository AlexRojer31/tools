<?php

namespace Tools;

use PHPUnit\Framework\TestCase;

class RandomizerTest extends TestCase
{

    /**
     * @covers Randomizer::getString
     */
    public function testGetString() : void
    {
        $code = Randomizer::getString(-1);
        $this->assertIsString($code);
        $this->assertRegExp('/^$/', $code);

        $code = Randomizer::getString(0);
        $this->assertIsString($code);
        $this->assertRegExp('/^$/', $code);

        $code = Randomizer::getString(1);
        $this->assertIsString($code);
        $this->assertRegExp('/^[a-zA-Z]{1}$/', $code);

        $code = Randomizer::getString(10);
        $this->assertIsString($code);
        $this->assertRegExp('/^[a-zA-Z]{10}$/', $code);
    }

    /**
     * @covers Randomizer::getNumber
     */
    public function testGetNumber() : void
    {
        $code = Randomizer::getNumber(-1);
        $this->assertIsNumeric($code);
        $this->assertRegExp('/^[0]$/', $code);

        $code = Randomizer::getNumber(0);
        $this->assertIsNumeric($code);
        $this->assertRegExp('/^[0]$/', $code);

        $code = Randomizer::getNumber(1);
        $this->assertIsNumeric($code);
        $this->assertRegExp('/^[0-9]{1}$/', $code);

        $code = Randomizer::getNumber(10);
        $this->assertIsNumeric($code);
        $this->assertRegExp('/^[0-9]{10}$/', $code);
    }

    /**
     * @covers Randomizer::getStringAndNumber
     */
    public function testGetStringAndNumber() : void
    {
        $code = Randomizer::getStringAndNumber(-1);
        $this->assertIsString($code);
        $this->assertRegExp('/^$/', $code);

        $code = Randomizer::getStringAndNumber(0);
        $this->assertIsString($code);
        $this->assertRegExp('/^$/', $code);

        $code = Randomizer::getStringAndNumber(1);
        $this->assertIsString($code);
        $this->assertRegExp('/^[0-9a-zA-Z]{1}$/', $code);

        $code = Randomizer::getStringAndNumber(10);
        $this->assertIsString($code);
        $this->assertRegExp('/^[0-9a-zA-Z]{10}$/', $code);
    }

    /**
     * @covers Randomizer::getHash
     */
    public function testGetHash() : void
    {
        $str = 'test string';
        $first = Randomizer::getHash($str);
        $second = Randomizer::getHash($str);
        $third = Randomizer::getHash('another string');
        $this->assertIsString($first);
        $this->assertIsString($second);
        $this->assertIsString($third);
        $this->assertRegExp('/^[0-9a-zA-Z]{32}$/', $first);
        $this->assertRegExp('/^[0-9a-zA-Z]{32}$/', $second);
        $this->assertRegExp('/^[0-9a-zA-Z]{32}$/', $third);
        $this->assertSame($first, $second);
        $this->assertNotSame($first, $third);
    }
}

