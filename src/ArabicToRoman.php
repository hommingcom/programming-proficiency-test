<?php

namespace App;

class ArabicToRoman
{
    public const array VALUES = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1];
    public const array SYMBOLS = ['M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I'];

    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return ?string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): ?string
    {
        if ($arabicNumber <= 0) {
            return null;
        }

        $romanNumber = '';
        $length = count(self::VALUES);

        for ($i = 0; $i < $length; $i++) {
            $value = self::VALUES[$i];
            if ($arabicNumber >= $value) {
                $count = (int) ($arabicNumber / $value);
                $romanNumber .= str_repeat(self::SYMBOLS[$i], $count);
                $arabicNumber %= $value;
            }
        }

        return $romanNumber;
    }

    public static function transformOld(int $arabicNumber): ?string
    {
        if ($arabicNumber <= 0) {
            return null;
        }

        $romanNumber = '';
        $length = count(self::VALUES);

        for ($i = 0; $i < $length; $i++) {
            $value = self::VALUES[$i];
            while ($arabicNumber >= $value) {
                $romanNumber .= self::SYMBOLS[$i];
                $arabicNumber -= $value;
            }
        }

        return $romanNumber;
    }

}