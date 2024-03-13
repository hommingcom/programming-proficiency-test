<?php

namespace App;

class ArabicToRoman
{
    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string|null The roman number equivalent (e.g. CXXI) or null if the input is invalid.
     */
    public static function transform(int $arabicNumber): ?string
    {

        // me fijo si el número es menor o igual a 0 o mayor que 3999
        if ($arabicNumber <= 0 || $arabicNumber > 3999) {
            //si lo es retorno null
            return null; 
        }

        //esta variable va a almacenar el número romano
        $romanNumber = '';

        //defino como se van a relacionar los números arabes con los números romanos
        $rels = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        //hago un foreach que recorra cada valor de ese array
        foreach ($rels as $rel => $value) {
        //en la variable time almaceno el resultado de la división del n° arabigo por el value
        //con el floor redondeo para abajo para que me de un número entero 
        $time = floor($arabicNumber / $value);
        //utilizo la fn de php str_repeat para para repetir el número romano que va a estar 
        //relacionado con dicho n° arabigo, la cantidad de veces que dio como resultado el time
        $romanNumber .= str_repeat($rel, $time);
        //convierto el número arabigo al resto de la división con el value , y luego el foreach lo vuelve a recorrer hasta que ya no hay más n° por convertir
        $arabicNumber %= $value;
        
        }
//retorno el resultado
        return $romanNumber;
    }
}
