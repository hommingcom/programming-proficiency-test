<?php

namespace App;

class ArabicToRoman
{
    // Array with equivalences between Arabic numbers and Roman numbers 
    private const EQUIVALENCES = array(
        1000    =>  'M' ,
        900     =>  'CM',
        500     =>  'D' ,
        400     =>  'CD',
        100     =>  'C' ,
        90      =>  'XC',
        50      =>  'L' ,
        40      =>  'XL',
        10      =>  'X' ,
        9       =>  'IX',
        5       =>  'V' ,
        4       =>  'IV',
        1       =>  'I' 
    );

    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string
    {
        // Declared $romanNumber as an empty string
        $romanNumber    =   '';
        // Check if $arabicNumber is 0 or negative return null 
        if($arabicNumber < 1)
        {
            return  '';
        }
        // Equivalences loop 
        foreach (self::EQUIVALENCES as $arabic => $roman) 
        {
            if ($arabicNumber >= $arabic)
            {
                // Divide the current number by the value of the given key to get the number of repetitions of each value 
                $times  = intval($arabicNumber / $arabic);
                $romanNumber .= str_repeat($roman, $times);
                // Update the value from $arabicNumber using % operator    
                $arabicNumber = $arabicNumber % $arabic;
            }
        }
        return $romanNumber;
    }
}