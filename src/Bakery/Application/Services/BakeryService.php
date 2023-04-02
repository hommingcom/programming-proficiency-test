<?php

namespace App\Bakery\Application\Services;


use App\Bakery\Domain\Entities\Recipe;
use App\Bakery\Domain\Interfaces\RecipeRepositoryInterface;
use App\Bakery\Domain\Services\BakeryDomainService;

readonly class BakeryService
{
    public function __construct(private RecipeRepositoryInterface $recipeRepository)
    {}

    public function calculateOutput(string $recipeName, array $ingredients): int
    {
        $recipeDTO = $this->recipeRepository->getRecipeByName($recipeName);

        if (!$recipeDTO) {
            return 0;
        }

        $recipe = new Recipe($recipeDTO->name, $recipeDTO->ingredients);
        return BakeryDomainService::calculateOutput($recipe, $ingredients);
    }
}