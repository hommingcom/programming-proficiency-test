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

   // Mientras el número arabe que te pasan, sea mayor o igual a valor del actual de relación 

            while ($arabicNumber >= $value) {
                //agrego el simbolo romano al resultado
                //ejemplo 130, 100=C  y 30 = XXX
                $romanNumber .= $rel;
                //le resto su valor del número, para continuar convirtiendo el siguiente
                //130 = C30
                // y luego CXXX
                $arabicNumber -= $value;
            }
        }
//retorno el resultado
        return $romanNumber;
    }
}
