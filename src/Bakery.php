<?php

namespace App;

class Bakery
{
    /**
     * Calculate the output of cakes for a given recipe
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The number of cakes you can bake
     */
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        $numberOfCakes = PHP_INT_MAX;
        $missingIngredients = array_diff_key($recipe, $ingredients);

        if (!empty($missingIngredients)) {
            return 0;
        }

        foreach ($recipe as $ingredient => $amount) {
            $numberOfCakes = min($numberOfCakes, intdiv($ingredients[$ingredient], $amount));
        }

        return $numberOfCakes;
    }

}