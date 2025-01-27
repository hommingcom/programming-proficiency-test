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
     * @return ?int The number of cakes you can bake
     */
    public static function calculateOutput(array $recipe, array $ingredients): ?int
    {
        if (empty($recipe)) {
            return null;
        }

        if (count($recipe) > count($ingredients)) {
            return 0;
        }

        $maxPossibleCakes = PHP_INT_MAX;

        foreach ($recipe as $ingredient => $amountNeeded) {
            if (! isset($ingredients[$ingredient]) || $ingredients[$ingredient] < $amountNeeded) {
                return 0;
            }

            $cakesForIngredient = intdiv($ingredients[$ingredient], $amountNeeded);

            if ($cakesForIngredient < $maxPossibleCakes) {
                $maxPossibleCakes = $cakesForIngredient;
            }
        }

        return $maxPossibleCakes;
    }

}