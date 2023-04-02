<?php

namespace App\Bakery\Domain\Interfaces;

use App\Bakery\Domain\DTO\RecipeDTO;

interface RecipeRepositoryInterface
{
    public function getRecipeByName(string $recipeName): ?RecipeDTO;
}