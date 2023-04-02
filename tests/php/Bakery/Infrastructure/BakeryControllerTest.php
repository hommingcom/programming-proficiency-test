<?php

namespace Tests\Bakery\Infrastructure;

use App\Bakery\Application\Services\BakeryService;
use App\Bakery\Domain\DTO\RecipeDTO;
use App\Bakery\Domain\Interfaces\RecipeRepositoryInterface;
use App\Bakery\Infrastructure\Controllers\BakeryController;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BakeryControllerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCalculateOutput()
    {
        $recipeName = 'cake';
        $ingredients = [
            'flour' => 1500,
            'sugar' => 600,
            'eggs' => 9,
        ];

        $recipeDTO = new RecipeDTO(
            name: 'cake',
            ingredients: [
                'flour' => 500,
                'sugar' => 200,
                'eggs' => 3,
            ]
        );

        $recipeRepository = $this->createMock(RecipeRepositoryInterface::class);
        $recipeRepository->method('getRecipeByName')
            ->willReturn($recipeDTO);

        $bakeryService = new BakeryService($recipeRepository);
        $bakeryController = new BakeryController($bakeryService);

        $expectedCakes = 3;
        $actualCakes = $bakeryController->calculateOutput($recipeName, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }
}