<?php

namespace App;

class ArabicToRoman
{
    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string
    {
        $romanNumber = '';

        // Equivalence array that maps each roman number to its correspoding arabic value
        $equivalences = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        // Loop through the $equivalences array
        foreach($equivalences as $equivalence => $value){
            // While the $arabicNumber is greater than or equal to the current arabic value
            while ($arabicNumber>=$value){
                // Append the current roman number to the result
                $romanNumber .= $equivalence;
                // Substract the current arabic value from the $arabicNumber
                $arabicNumber = $arabicNumber - $value;
            }
        }
        
        return $romanNumber;
    }
}