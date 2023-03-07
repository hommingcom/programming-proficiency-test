<?php

namespace App;

use Throwable;

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
        $units = [];

        try{
            foreach($recipe as $ingredient => $ingredientUnit){
                $ingredientUnitCount = $ingredients[$ingredient];
                $units[] = intdiv($ingredientUnitCount, $ingredientUnit);
            }
        }catch(Throwable){
            return 0;
        }
        
        $numberOfCakes = min($units);

        return $numberOfCakes;
    }
}