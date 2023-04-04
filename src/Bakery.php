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

        $availableIngredients = array_keys($ingredients);
        $requiredIngredients = array_keys($recipe);

        if(!self::hasRequiredIngredients($availableIngredients,$requiredIngredients)){
            return 0;
        }

        $maxCakesPerIngredient = [];
        foreach ($ingredients as $ingredient => $amount){
            if(isset($recipe[$ingredient])){
                $max = floor($amount/$recipe[$ingredient]);
                $maxCakesPerIngredient[] = (int) $max;
            }
        }
        return min($maxCakesPerIngredient);

    }

    private static function hasRequiredIngredients(array $availableIngredients, array $requiredIngredients ): bool
    {
        foreach ($requiredIngredients as $requiredIngredient){
            if(!in_array($requiredIngredient,$availableIngredients)){
                return false;
            }
        }
        return true;
    }
}