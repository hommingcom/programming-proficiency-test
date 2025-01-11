<?php

namespace App;

class ArabicToRoman
{
    private const MIN_VALUE = 1;
    private const ERROR_NUMBER_INVALID = null;
    private const ARABIC_TO_ROMAN_MAPPING = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
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

        if($arabicNumber < self::MIN_VALUE)
            return self::ERROR_NUMBER_INVALID;

        $romanNumber = '';

        foreach (self::ARABIC_TO_ROMAN_MAPPING as $arabicValue => $romanValue) {
            if ($arabicNumber >= $arabicValue) {
                $count = intdiv($arabicNumber, $arabicValue);
                $romanNumber .= str_repeat($romanValue, $count);
                $arabicNumber -= $arabicValue * $count;
            }
        }

        return $romanNumber;
    }
}