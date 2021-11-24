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
        $enoughIngredientes = true;

        // Si falta algun ingrediente no se puede continuar y devolvemos 0
        $diffBettewnArrays = array_diff_key($recipe, $ingredients);
        if (!empty($diffBettewnArrays)) {
            return 0;
        }

        while ($enoughIngredientes) {
            foreach ($recipe as $key => $recipeValue) {
                if ($ingredients[$key] >= $recipeValue) {
                    $ingredients[$key] -= $recipeValue;
                } else {
                    $enoughIngredientes = false;
                }
            }
            if ($enoughIngredientes) {
                $numberOfCakes++;
            }
        }

        return $numberOfCakes;
    }
	
}
