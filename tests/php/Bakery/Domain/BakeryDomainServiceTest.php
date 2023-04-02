<?php

namespace Tests\Bakery\Domain;

use App\Bakery\Domain\Entities\Recipe;
use App\Bakery\Domain\Services\BakeryDomainService;
use PHPUnit\Framework\TestCase;

class BakeryDomainServiceTest extends TestCase
{
    public function test_calculate_output()
    {
        $recipe = new Recipe('cake', [
            'flour' => 500,
            'sugar' => 200,
            'eggs' => 3,
        ]);

        $availableIngredients = [
            'flour' => 1500,
            'sugar' => 600,
            'eggs' => 9,
        ];

        $expectedCakes = 3;

        $actualCakes = BakeryDomainService::calculateOutput($recipe, $availableIngredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }

    public function test_apple_pie()
    {
        $recipe = new Recipe('apple_pie', [
            'flour' => 700,
            'eggs' => 2,
            'apples' => 4,
            'sugar' => 1000
        ]);

        $ingredients = [
            'flour' => 1400,
            'eggs' => 3,
            'apples' => 21,
            'sugar' => 2500
        ];

        $expectedCakes = 1;
        $actualCakes = BakeryDomainService::calculateOutput($recipe, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }

    public function test_cheese_cake()
    {
        $recipe = new Recipe('cheesecake', [
            'flour' => 950,
            'biscuit' => 200,
            'cheese' => 500,
            'cream' => 600,
            'sugar' => 1000
        ]);

        $ingredients = [
            'flour' => 4800,
            'biscuit' => 750,
            'cheese' => 2100,
            'cream' => 2600,
            'sugar' => 4000
        ];

        $expectedCakes = 3;
        $actualCakes = BakeryDomainService::calculateOutput($recipe, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }

    public function test_carrot_cake()
    {
        $recipe = new Recipe('carrot_cake', [
            'flour' => 700,
            'carrot' => 500,
            'cream' => 200,
            'cinnamon' => 50,
            'vanilla' => 10,
            'sugar' => 300
        ]);

        $ingredients = [
            'flour' => 3100,
            'carrot' => 1200,
            'cream' => 500,
            'cinnamon' => 240,
            'sugar' => 4000
        ];

        $expectedCakes = 0;
        $actualCakes = BakeryDomainService::calculateOutput($recipe, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }

    public function test_lemon_cake()
    {
        $recipe = new Recipe('lemon_cake', [
            'flour' => 1200,
            'lemon' => 100,
            'cream' => 200,
            'sugar' => 300
        ]);

        $ingredients = [
            'flour' => 7900,
            'lemon' => 1200,
            'cream' => 5200,
            'vanilla' => 100,
            'sugar' => 4000
        ];

        $expectedCakes = 6;
        $actualCakes = BakeryDomainService::calculateOutput($recipe, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }
}