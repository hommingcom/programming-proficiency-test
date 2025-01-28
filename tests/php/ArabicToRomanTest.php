<?php

namespace Tests;

use App\ArabicToRoman;
use PHPUnit\Framework\TestCase;

class ArabicToRomanTest extends TestCase
{
    function testNegative()
    {
        $this->assertEquals(null, ArabicToRoman::transform(-10));
        $this->assertEquals(null, ArabicToRoman::transformOld(-10));
    }

    function test0()
    {
        $this->assertEquals(null, ArabicToRoman::transform(0));
        $this->assertEquals(null, ArabicToRoman::transformOld(0));
    }

    function test1()
    {
        $this->assertEquals('I', ArabicToRoman::transform(1));
        $this->assertEquals('I', ArabicToRoman::transformOld(1));
    }

    function test4()
    {
        $this->assertEquals('IV', ArabicToRoman::transform(4));
        $this->assertEquals('IV', ArabicToRoman::transformOld(4));
    }

    function test6()
    {
        $this->assertEquals('VI', ArabicToRoman::transform(6));
        $this->assertEquals('VI', ArabicToRoman::transformOld(6));
    }

    function test114()
    {
        $this->assertEquals('CXIV', ArabicToRoman::transform(114));
        $this->assertEquals('CXIV', ArabicToRoman::transformOld(114));
    }

    function test166()
    {
        $this->assertEquals('CLXVI', ArabicToRoman::transform(166));
        $this->assertEquals('CLXVI', ArabicToRoman::transformOld(166));
    }

    function test489()
    {
        $this->assertEquals('CDLXXXIX', ArabicToRoman::transform(489));
        $this->assertEquals('CDLXXXIX', ArabicToRoman::transformOld(489));
    }

    function test999()
    {
        $this->assertEquals('CMXCIX', ArabicToRoman::transform(999));
        $this->assertEquals('CMXCIX', ArabicToRoman::transformOld(999));
    }

    function test1369()
    {
        $this->assertEquals('MCCCLXIX', ArabicToRoman::transform(1369));
        $this->assertEquals('MCCCLXIX', ArabicToRoman::transformOld(1369));
    }

    function test3999()
    {
        $this->assertEquals('MMMCMXCIX', ArabicToRoman::transform(3999));
        $this->assertEquals('MMMCMXCIX', ArabicToRoman::transformOld(3999));
    }

    function testPerformance()
    {
        $time = 300000;
        $timeOriginal = $this->measurePerformance([ArabicToRoman::class, 'transform'], $time);

        $timeOld = $this->measurePerformance([ArabicToRoman::class, 'transformOld'], $time);

        echo "\n:New version time " . number_format($timeOriginal, 5) . " segundos\n";
        echo "Old version time:" . number_format($timeOld, 5) . " segundos\n";
    }

    private function measurePerformance(callable $function, int $iterations): float
    {
        $startTime = microtime(true);

        for ($i = 1; $i <= $iterations; $i++) {
            $function($i);
        }

        $endTime = microtime(true);

        return $endTime - $startTime;
    }
}