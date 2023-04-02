<?php

namespace Tests\Bakery\Domain;

use App\Bakery\Domain\Entities\Recipe;
use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase
{
    public function test_recipe_creation_and_getters()
    {
        $recipeName = 'cake';
        $ingredients = [
            'flour' => 500,
            'sugar' => 200,
            'eggs' => 3,
        ];

        $recipe = new Recipe($recipeName, $ingredients);

        $this->assertSame($recipeName, $recipe->getName());
        $this->assertSame($ingredients, $recipe->getIngredients());
    }
}