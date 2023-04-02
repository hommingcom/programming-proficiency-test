<?php

namespace Tests\Bakery\Application;


use App\Bakery\Application\Services\BakeryService;
use App\Bakery\Domain\DTO\RecipeDTO;
use App\Bakery\Domain\Interfaces\RecipeRepositoryInterface;
use App\Bakery\Infrastructure\Repositories\RecipeRepository;
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

        $recipeRepository = new RecipeRepository(); // In a real application this would go in a service container

        $bakeryService = new BakeryService($recipeRepository);

        $expectedCakes = 3;
        $actualCakes = $bakeryService->calculateOutput($recipeName, $ingredients);

        $this->assertEquals($expectedCakes, $actualCakes);
    }
}