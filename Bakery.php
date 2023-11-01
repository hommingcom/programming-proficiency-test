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

        // increase the memory limit
        ini_set('memory_limit','128M');

        $numberOfCakes = 0;

        // check info
        if(is_null($recipe) || is_null($ingredients) || !is_array($recipe) || !is_array($ingredients)) return 0;

        // remove ingredients we dont need
        $ingredientsnew = array_intersect_key($ingredients, array_flip(array_keys($recipe)));

        // create array with min ingredients
        $out = array_map(function ($a,$b) { return !empty($b) ? floor($a / $b) : null; },$ingredientsnew,$recipe);

        // remove nulls
        $out = array_filter($out, function ($x) { return !is_null($x); });

        // get min
        $numberOfCakes = min($out);

        return $numberOfCakes;
    }



}
