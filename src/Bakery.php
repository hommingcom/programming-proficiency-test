<?php

namespace App;

class Bakery
{
    /**
     * Calculate the output of cakes for a giver recipe
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The number of cakes you can bake
     */
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        $numberOfCakes = PHP_INT_MAX;

        // Check if there are enough ingredients to make at least one cake
        foreach ($recipe as $ingredient => $amountNeeded) {
            if (!array_key_exists($ingredient, $ingredients) || $ingredients[$ingredient] < $amountNeeded) {
                $numberOfCakes = 0;
                break;
            }
            $numberOfCakes = min($numberOfCakes, intval($ingredients[$ingredient] / $amountNeeded));
        }

        return $numberOfCakes;
    }
}