<?php

namespace App\Bakery\Infrastructure\Repositories;

use App\Bakery\Domain\DTO\RecipeDTO;
use App\Bakery\Domain\Interfaces\RecipeRepositoryInterface;


class RecipeRepository implements RecipeRepositoryInterface
{
    private array $recipeDTOs;

    public function __construct()
    {
        $this->recipeDTOs = [
            'cake' => new RecipeDTO('cake', [
                'flour' => 500,
                'sugar' => 200,
                'eggs' => 3
            ])
        ];
    }

    public function getRecipeByName(string $recipeName): ?RecipeDTO
    {
        return $this->recipeDTOs[$recipeName] ?? null;
    }
}
