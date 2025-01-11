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
        if(count($recipe) == 0 || count($ingredients) == 0)
            return 0;

        $numberOfCakes = 0;

        foreach($recipe as $ingredient => $amountNeeded) {
            if(!isset($ingredients[$ingredient]))
                return 0;
            $cakesPossible = intdiv($ingredients[$ingredient],$amountNeeded);
            if($numberOfCakes == 0 || $cakesPossible < $numberOfCakes)
                $numberOfCakes = $cakesPossible;
        }

        return $numberOfCakes;
    }
}