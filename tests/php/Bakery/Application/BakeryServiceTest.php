<?php

namespace Tests\Bakery\Application;


use App\Bakery\Application\Services\BakeryService;
use App\Bakery\Domain\DTO\RecipeDTO;
use App\Bakery\Domain\Interfaces\RecipeRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class BakeryServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_calculate_output()
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

        $expectedCakes = 3;
        $actualCakes = $bakeryService->calculateOutput($recipeName, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }
}