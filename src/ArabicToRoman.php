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

        if ($arabicNumber <= 0 || $arabicNumber >= 4000) {
            return ""; 
        }

        $romanNumerals = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        ];

        foreach ($romanNumerals as $roman => $value) {
            while ($arabicNumber >= $value) {
                $romanNumber .= $roman;
                $arabicNumber -= $value;
            }
        }

        return $romanNumber;
    }
}