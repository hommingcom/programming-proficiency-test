<?php

namespace App\Bakery\Domain\Services;

use App\Bakery\Domain\Entities\Recipe;

class BakeryDomainService
{
    public static function calculateOutput(Recipe $recipe, array $availableIngredients): int
    {
        $numberOfCakes = PHP_INT_MAX;
        $recipeIngredients = $recipe->getIngredients();

        foreach ($recipeIngredients as $ingredient => $amount) {
            if (!array_key_exists($ingredient, $availableIngredients)) {
                return 0;
            }
            $numberOfCakes = min($numberOfCakes, $availableIngredients[$ingredient] / $amount);
        }

        return (int) floor($numberOfCakes);
    }
}