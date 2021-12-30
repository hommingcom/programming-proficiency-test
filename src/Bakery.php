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
        return Bakery::getTotalCakes($recipe, $ingredients);
    }

    private static function getTotalCakes(array $recipe, array $ingredients): int
    {
        $cakes = 0;
        foreach ($recipe as $ingredient => $value) {
            if (Bakery::exitsKey($ingredients, $ingredient)) return 0;                  // Comprueba que exista los productos de la receta en los ingredientes

            if ($ingredients[$ingredient]) {                                            // Comprueba que existan los ingredientes en la receta
                $possibleCakes = floor($ingredients[$ingredient] / $value);        // Calculamos el numero de tartas que podemos hacer con cada ingrediente y lo redondeamos hacia abajo

                if (!$cakes || $possibleCakes < $cakes) {                               // Buscamos el numero menor de tartas que podemos hacer
                    $cakes = $possibleCakes;
                }
            }
        }

        return $cakes;
    }

    private static function exitsKey(array $ingredients, string $ingredient): int
    {
        if (!property_exists((object)$ingredients, $ingredient)) {
            return true;
        }

        return false;
    }
}