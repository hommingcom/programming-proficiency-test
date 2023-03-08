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
        //I've made an array to store the number of cakes that could be made from EACH ingredient
        $ingredientCapacity = [];
    
        //Iteration over each item in the array of recipe, getting the minimun amount of the ingredients to get a cake
        foreach ($recipe as $ingredient => $minAmount) {
         /* Then is necessary this check that the ingridient exists in the $ingredients array, if not we return 0 to our empty array
            If it does exist, then we calculate the max num of cakes (dividing ingredient we have by the min necesary) and we take
            the round the result with the min result with floor since we should not get 1,5 cakes or any float num. */ 
            if (!array_key_exists($ingredient, $ingredients)) {
                $ingredientCapacity[] = 0;
            } else {
                $maxCapacity = floor($ingredients[$ingredient] / $minAmount);
                $ingredientCapacity[] = $maxCapacity;
            }
        }
        //Finally we take the max num of cakes based on the min value finded in our array
        $totalCakes = min($ingredientCapacity);
        return $totalCakes;
    }
}
