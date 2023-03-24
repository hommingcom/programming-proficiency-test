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
        $numberOfCakes = 0;
    
        // foreach ingredient in the recipe, check if there is enough of it to make at least one cake
        foreach ($recipe as $ingredient => $amountNeeded) {
            if (!isset($ingredients[$ingredient]) || $ingredients[$ingredient] < $amountNeeded) {
                // If there is not enough ingredients return $numberOfCakes
                break;
            }
            
            // Calculate the number of cakes
            $possibleCakes = floor($ingredients[$ingredient] / $amountNeeded);
            if ($numberOfCakes == 0 || $possibleCakes < $numberOfCakes) {
                $numberOfCakes = $possibleCakes;
            }
        }
    
        return $numberOfCakes;
    }
}