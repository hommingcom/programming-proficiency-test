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
        $minCakes = PHP_INT_MAX;

        foreach ($recipe as $ingredient => $amount) {
            if (!isset($ingredients[$ingredient]) || $amount <= 0) {
                return 0; 
            }

            if (intval($ingredients[$ingredient] / $amount) < $minCakes) {
                $minCakes = intval($ingredients[$ingredient] / $amount);
            }
        }

        return $minCakes;
    }
}