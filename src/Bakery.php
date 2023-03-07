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


        // $recipe = [
        //     'ingrediente 1' => 500,
        //     'ingrediente 2' => 236,
        //     'ingrediente 3' => 125,
        //     'ingrediente 4' => 656,
        //     'ingrediente 5' => 335
        // ];


        // $ingredients = [
        //     'ingrediente 1' => 12500,
        //     'ingrediente 2' => 13236,
        //     'ingrediente 3' => 12125,
        //     'ingrediente 4' => 12656,
        //     'ingrediente 5' => 1400
        // ];

        $numberOfCakes = 0;

        do{
            //comprueba que todos los ingredientes tienen cantidad suficiente para realizar la receta
            $ingredients = $this->checkIngredients($recipe,$ingredients);
            if($ingredients != false) $numberOfCakes++;              
           
        }while($ingredients != false);
       

        return $numberOfCakes;
    }

    

    public function checkIngredients($recipe,$ingredients){
        //recorre el array de ingredientes
        foreach($ingredients as $key => $value){
            if($recipe[$key] <= $value){
                //si hay suficiente cantidad, resta la cantidad que se ha utilizado para realizar la tarea
                $ingredients[$key] = $value - $recipe[$key];
            }else{
                //si no hay cantidad suficiente, retorna falso.
                return false;
            }
        }


        return $ingredients;


    }


}
?>
