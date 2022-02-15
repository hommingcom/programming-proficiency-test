<?php

namespace App\Classes;

class BakeryDM
{
    /**
     * Possible cakes we can cook :p
     *
     * @param array $recipe of the cake 
     * 
     * @param array $ingredients we have
     *
     * @return int total cakes
     */
    public function possibleCakes(array $recipe, array $ingredients): int
    {        
        if($this->enoughIngredients($recipe, $ingredients)){
            $numCakes = [];
            $needeedIngredients = $this->filterIngredients($recipe, $ingredients);

            foreach($needeedIngredients as $nameIngredient => $quantity){
                $numCakes[] = floor($quantity/$recipe[$nameIngredient]);
            }
            
            return min($numCakes);
        }

        return 0;
    }

    /**
     * Check if we have all the needed ingredients
     *
     * @param array $recipe of the cake 
     * 
     * @param array $ingredients we have
     *
     * @return boolean 
     */
    public function enoughIngredients(array $recipe, array $ingredients)
    {
        return array_diff_key($recipe, $ingredients) ? false : true;
    }

    /**
     * We just gonna use de needed ingredients
     *
     * @param array $recipe of the cake 
     * 
     * @param array $ingredients we have
     *
     * @return array clean array with needed ingredients
     */
    public function filterIngredients(array $recipe, array $ingredients)
    {
        return array_intersect_key($ingredients, $recipe);
    }
}