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
        //Se le asigna el valor max disponible
        $numberOfCakes = PHP_INT_MAX;

        //con el foreach recorro cada elemento necesario de las recetas
        foreach ($recipe as $ingredient => $amountNecessary) {

            //obtengo la cantidad de igrediente actual, y si no hay ingrediente disponible le asigno 0 como cantidad
            $QuantityAvailable = $ingredients[$ingredient] ?? 0;

            //me fijo si la cantidad necesaria e menor a la cantidad disponible
            if ($amountNecessary < $QuantityAvailable) {
                $maxCakes = floor($QuantityAvailable / $amountNecessary);
                $numberOfCakes = min($numberOfCakes, $maxCakes);
            } else {
                //en caso contrario retorno un 0 y aviso que no alcanza para preparar la receta
                echo "No se pueden hacer pasteles con esa cantidad de ingredientes." . PHP_EOL;
                return 0;
            }
        }

         // Retorno la cantidad de pasteles 
         return $numberOfCakes;
    }
    }