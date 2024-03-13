<?php

namespace UnitTestFiles\Test;

use App\Bakery;
use PHPUnit\Framework\TestCase;

class BakeryTest extends TestCase
{
    //todos estos son los test que me brindaron 
    function testApplePie()
    {
        $this->assertEquals(1, Bakery::calculateOutput(
            ['flour' => 700, 'eggs' => 2, 'apples' => 4, 'sugar' => 1000],
            ['flour' => 1400, 'eggs' => 3, 'apples' => 21, 'sugar' => 2500]
        ));
    }

    function testCheeseCake()
    {
        $this->assertEquals(3, Bakery::calculateOutput(
            ['flour' => 950, 'biscuit' => 200, 'cheese' => 500, 'cream' => 600, 'sugar' => 1000],
            ['flour' => 4800, 'biscuit' => 750, 'cheese' => 2100, 'cream' => 2600, 'sugar' => 4000]
        ));
    }

    function testCarrotCake()
    {
        $this->assertEquals(0, Bakery::calculateOutput(
            ['flour' => 700, 'carrot' => 500, 'cream' => 200, 'cinnamon' => 50, 'vanilla' => 10, 'sugar' => 300],
            ['flour' => 3100, 'carrot' => 1200, 'cream' => 500, 'cinnamon' => 240, 'sugar' => 4000]
        ));
    }

    function testLemonCake()
    {
        $this->assertEquals(6, Bakery::calculateOutput(
            ['flour' => 1200, 'lemon' => 100, 'cream' => 200, 'sugar' => 300],
            ['flour' => 7900, 'lemon' => 1200, 'cream' => 5200, 'vanilla' => 100, 'sugar' => 4000]
        ));
    }

    function testCthulhuCake()
    {
        $this->assertEquals(10, Bakery::calculateOutput(
            array_fill(0, 1000000, 100),
            array_fill(0, 1000000, 1000),
        ));
    }

    //este test lo agregue yo para probar que pasa si hubiera más cantidad de pruebas aleatorias.
    function testPlus()
    {
        for ($i = 0; $i < 332; $i++) {
            $recipe = [
                'ingredient1' => rand(100, 3000),
                'ingredient2' => rand(50, 500),
                'ingredient3' => rand(20, 30),
            ];

            $ingredients = [
                'ingredient1' => rand(500, 4000),
                'ingredient2' => rand(400, 850),
                'ingredient3' => rand(0),
            ];

            $output = Bakery::calculateOutput($recipe, $ingredients);

            $this->assertGreaterThanOrEqual(0, $output);
            $this->assertIsInt($output);
        }
    }
    
}
