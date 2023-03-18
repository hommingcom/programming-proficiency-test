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
        // Set initial maximum number of cakes to the maximum possible number of cakes with the given ingredients
        $numberOfCakes = PHP_INT_MAX;

        // Iterate through each ingredient required for the recipe
        foreach ($recipe as $ingredient => $amountNeeded) {
            // Check if the ingredient is available in the required amount
            if (!isset($ingredients[$ingredient]) || $ingredients[$ingredient] < $amountNeeded) {
                // The ingredient is not available in the required amount, so no cakes can be made
                $numberOfCakes = 0;
                break;
            } else {
                // Calculate the maximum number of cakes that can be made with this ingredient
                $maxCakesWithIngredient = (int)($ingredients[$ingredient] / $amountNeeded);
                if ($maxCakesWithIngredient < $numberOfCakes) {
                    // Update the maximum number of cakes if it is less than the current maximum
                    $numberOfCakes = $maxCakesWithIngredient;
                }
            }
        }

        return $numberOfCakes;
    }
}