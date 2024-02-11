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
        if (!self::hasEnoughIngredients($recipe, $ingredients)) {
            return 0;
        }

        return self::getMaxCakes($recipe, $ingredients);
    }

    /**
     * Check if there are enough ingredients to bake at least one cake
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return bool True if there are enough ingredients, otherwise false
     */
    private static function hasEnoughIngredients(array $recipe, array $ingredients): bool
    {
        foreach ($recipe as $ingredient => $amountNeeded) {
            if (!isset($ingredients[$ingredient]) || $ingredients[$ingredient] < $amountNeeded) {
                return false;
            }
        }
        return true;
    }

    /**
     * Calculate the maximum number of cakes that can be baked based on available ingredients
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The maximum number of cakes that can be baked
     */
    private static function getMaxCakes(array $recipe, array $ingredients): int
    {

        $ingredientNames = array_keys($recipe);
        $numberOfCakes = [];

        foreach ($ingredientNames as $ingredient) {
            $maxCakesForIngredient = (int) ($ingredients[$ingredient] / $recipe[$ingredient]);

            $numberOfCakes[] = $maxCakesForIngredient;
        }

        $maxCakes = min($numberOfCakes);

        return $maxCakes;
}