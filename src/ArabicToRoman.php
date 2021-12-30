<?php

namespace App;

class ArabicToRoman
{
    const NUMBER_ROMAN = [
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
    ];

    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string
    {
        if (ArabicToRoman::checkNegativeNumbers($arabicNumber)) {
            return false;
        }

        return ArabicToRoman::getNumber($arabicNumber);
    }

    private static function getNumber(int $arabicNumber): string
    {
        $romanNumber = '';

        foreach (ArabicToRoman::NUMBER_ROMAN as $number_roman => $number) {
            $matches = $arabicNumber / $number;                                     // Devuelve 0 si no encuentra coincidencias y 1 si encuentra
            $romanNumber = $romanNumber . str_repeat($number_roman, $matches);      // Concatena todos los numeros romanos
            $arabicNumber = $arabicNumber % $number;                                // Resta el valor dado para dejar solo la cadena correcta
        }

        return $romanNumber;
    }

    private static function checkNegativeNumbers(int $number): bool
    {
        if($number <= 0) {
            return true;
        }
        return false;
    }
}