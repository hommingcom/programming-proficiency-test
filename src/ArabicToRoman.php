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
    public static function transform(int $arabicNumber): mixed
    {
        $romanNumber = '';

        if ($arabicNumber <= 0) {
            return null;
        }

        $romanNumerals = array(
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
        
        // Iterate through the Roman numerals in descending order of their value
        foreach ($romanNumerals as $roman => $arabic) {
            // if the input number is >= to the $arabicNumber,
            // subtract the $arabicNumber from the input number and add the corresponding Roman numeral to the $romanNumber
            while ($arabicNumber >= $arabic) {
            $romanNumber .= $roman;
            $arabicNumber -= $arabic;
            }
        }
        return $romanNumber;

    }
}