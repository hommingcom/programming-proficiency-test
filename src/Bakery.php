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
        /** Loop each ingredient in recipe */
        foreach ($recipe as $key => $val){
            /**If not exist an ingredient for the recipe or the cuantity is less than the needed returns 0  */
            if(!isset($ingredients[$key]) || $ingredients[$key] < $val) return 0;
            /**Calculates how much recipes can do with this particular ingredient */
            $times = intval($ingredients[$key] / $val);
            /**If is the first iteraction or the $numberOfCakes we can do with this ingredient is less than $numberOfCakes update $numberOfCakes */
            if(!isset($numberOfCakes) || $numberOfCakes > $times)
                $numberOfCakes = $times;
        }
        return $numberOfCakes;
    }
}