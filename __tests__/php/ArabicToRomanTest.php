<?php

namespace UnitTestFiles\Test;

use App\ArabicToRoman;
use PHPUnit\Framework\TestCase;

class ArabicToRomanTest extends TestCase
{
    function testNegative()
    {
        $this->assertEquals(null, ArabicToRoman::transform(-10));
    }

    function test0()
    {
        $this->assertEquals(null, ArabicToRoman::transform(0));
    }

    function test1()
    {
        $this->assertEquals('I', ArabicToRoman::transform(1));
    }

    function test4()
    {
        $this->assertEquals('IV', ArabicToRoman::transform(4));
    }

    function test6()
    {
        $this->assertEquals('VI', ArabicToRoman::transform(6));
    }

    function test114()
    {
        $this->assertEquals('CXIV', ArabicToRoman::transform(114));
    }

    function test166()
    {
        $this->assertEquals('CLXVI', ArabicToRoman::transform(166));
    }

    function test489()
    {
        $this->assertEquals('CDLXXXIX', ArabicToRoman::transform(489));
    }

    function test999()
    {
        $this->assertEquals('CMXCIX', ArabicToRoman::transform(999));
    }

    function test1369()
    {
        $this->assertEquals('MCCCLXIX', ArabicToRoman::transform(1369));
    }

    function test3999()
    {
        $this->assertEquals('MMMCMXCIX', ArabicToRoman::transform(3999));
    }
}