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
        $numberOfCakes = INF;

        foreach ($recipe as $ingredient => $amount) {
            if (!array_key_exists($ingredient, $ingredients) || $numberOfCakes == 0) return 0;

            $available = $ingredients[$ingredient];
            $cakes = intdiv($available, $amount);
            $numberOfCakes = min($numberOfCakes, $cakes);
        }

        return $numberOfCakes;
    }
}
