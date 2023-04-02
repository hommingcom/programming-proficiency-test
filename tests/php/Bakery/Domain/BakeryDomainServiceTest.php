<?php

namespace Tests\Bakery\Domain;

use App\Bakery\Domain\Entities\Recipe;
use App\Bakery\Domain\Services\BakeryDomainService;
use PHPUnit\Framework\TestCase;

class BakeryDomainServiceTest extends TestCase
{
    public function testCalculateOutput()
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
}