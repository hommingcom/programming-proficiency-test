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

        // Complete the function
        $amount_ingredient_recipe=[];
        foreach($recipe as $ingredient=>$amount_recipe){
            if(isset($ingredients[$ingredient])){
                $amount_available=$ingredients[$ingredient];
                $times=intdiv($amount_available,$amount_recipe);
                array_push($amount_ingredient_recipe,$times);
            }
            else{
                return 0;
            }
        }
        $numberOfCakes=min($amount_ingredient_recipe);

        return $numberOfCakes;
    }
}