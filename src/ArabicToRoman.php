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
        $result = '';

        if ($arabicNumber <= 0 || $arabicNumber > 3999) {
            return $result;
        }

        $romanNumbersValue  = self::romanNumbersWithArabicValue();
        $romanNumberFined   = array_key_exists($arabicNumber, $romanNumbersValue);

        if ($romanNumberFined) {
            return $romanNumbersValue[$arabicNumber];
        }

        foreach ($romanNumbersValue as $arabicValue => $romanNumber) {
            while($arabicNumber >= $arabicValue) {
                $result .= $romanNumber;
                $arabicNumber -= $arabicValue;
            }
        }

        return $result;
    }

    private static function romanNumbersWithArabicValue(): array
    {
        return [
            1000 => 'M',
            900  => 'CM',
            500  => 'D',
            400  => 'CD',
            100  => 'C',
            90   => 'XC',
            50   => 'L',
            40   => 'XL',
            10   => 'X',
            9    => 'IX',
            5    => 'V',
            4    => 'IV',
            1    => 'I',
        ];
    }
}