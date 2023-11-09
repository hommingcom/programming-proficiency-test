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
        $cakesPerIngredient = [];
        foreach ($recipe as $ingredient => $amountNecessary) {
            if (array_key_exists($ingredient, $ingredients)) {
                $amountWeHave = $ingredients[$ingredient];

                $cakesPerIngredient[] = floor($amountWeHave / $amountNecessary);
            } else {
                echo "you dont have enough ingredients";
                return 0;
            }
        }

        $numberOfCakes = min($cakesPerIngredient);

        return $numberOfCakes;
    }
}
