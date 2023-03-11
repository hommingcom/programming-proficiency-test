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

        // Check if we have all the ingredients
        foreach ($recipe as $ingredient => $amount) {
            if(!array_key_exists($ingredient, $ingredients)) {
                return 0;
            }
        }
        
        // Calculate the minimum number of cakes we can make
        foreach ($ingredients as $ingredient => $amount) {
            if(array_key_exists($ingredient, $recipe)) {
                $numberOfCakes = Min($numberOfCakes, floor($amount / $recipe[$ingredient]));
            }
        }

        return $numberOfCakes;
    }
}