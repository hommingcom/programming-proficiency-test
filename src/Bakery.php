<?php

namespace App;

class Bakery
{
    /**
     * Calculate the output of cakes for a giver recipe
     *
     * @param array $recipe Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The number of cakes you can bake
     */
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        $numberOfCakes = 0;
        //If we have less items in ingredients than in the recipe there's no reason to carry on
        if (count($ingredients) < count($recipe)) {
            return 0;
        }
        foreach ($recipe as $ingredient => $amountRequired) {
            /*
             * If we assume that the order of ingredients is the same, I will first check if the amount of the ingredient
             * I have is less than the recipe’s requirement to decide whether to continue or not. The same if it is not
             * numeric or is null
             */
            if ($ingredients[$ingredient] < $amountRequired
                || !isset($ingredients[$ingredient]) || !is_numeric($ingredients[$ingredient])) {
                return 0;
            }
            $availableAmount = $ingredients[$ingredient];

            $cakesPossibleWithIngredient = floor($availableAmount / $amountRequired);
            if ($numberOfCakes === 0 || $cakesPossibleWithIngredient < $numberOfCakes) {
                $numberOfCakes = $cakesPossibleWithIngredient;
            }
        }
        return $numberOfCakes;
    }
}
