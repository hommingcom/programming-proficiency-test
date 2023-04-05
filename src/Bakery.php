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

        // Loop through each ingredient in the recipe
        foreach ($recipe as $ingredient => $quantity){
            // Check if the ingredient is missing or there isnt enough of it
            if(!isset($ingredients[$ingredient]) || $ingredients[$ingredient] < $quantity){
                // If so, we cant make any cakes so we return 0
                return 0;
            }

            // Calculate how many cakes we can make with the current ingredient
            $cakesPerIngredient = intval($ingredients[$ingredient] / $quantity);

            /** If we havent set $numberOfCakes yet or if we can make fewer cakes 
             *  with the current ingredient than the previus one, update $numberOfCakes
            */ 
            if ($numberOfCakes === 0 || $cakesPerIngredient < $numberOfCakes) {
                $numberOfCakes = $cakesPerIngredient;
            }
        }

        return $numberOfCakes;
    }
}