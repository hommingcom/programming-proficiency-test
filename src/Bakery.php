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

        foreach($recipe as $ingredient => $quantity) {
            if (!isset($ingredients[$ingredient])) {
                return 0; // If we don't have the ingredient, return 0
            }
            $numCakes = intdiv($ingredients[$ingredient], $quantity);
            if ($numCakes === 0) {
                return 0; // If we don't have enough of an ingredient, return 0
            }
            $numberOfCakes = min($numberOfCakes, $numCakes);
        }

        return $numberOfCakes;
    }
}