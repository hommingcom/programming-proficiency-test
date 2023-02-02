<?php

namespace App;

class ArabicToRoman
{
    const ROMANS = [
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
        'I'  => 1
    ];

    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): ?string
    {
        if ($arabicNumber <= 0) return null;

        $romanNumber = '';

        foreach (self::ROMANS as $letter => $value) {
            // Look for number of matches
            $matches = intdiv($arabicNumber, $value);

            // Concatenate characters
            $romanNumber .= str_repeat($letter, $matches);

            // Substract that from the number 
            $arabicNumber = $arabicNumber % $value;
        }

        return $romanNumber;
    }
}
