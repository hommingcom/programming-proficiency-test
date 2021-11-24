<?php

namespace App;

class ArabicToRoman
{

    private const ROMAN_VALUES = array(
        "I" => 1,
        'IV' => 4,
        "V" => 5,
        'IX' => 9,
        "X" => 10,
        'XL' => 40,
        "L" => 50,
        'XC' => 90,
        "C" => 100,
        'CD' => 400,
        "D" => 500,
        'CM' => 900,
        "M" => 1000,
    );


    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string|null The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string|null
    {
        $romanNumber = '';

        if ($arabicNumber > 0 && $arabicNumber <= 4000) {
            // Si el valor consultado se encuentra ya en el array lo devolvemos directamente
            $valueInArrayYet = array_search($arabicNumber, self::ROMAN_VALUES);
            if ($valueInArrayYet !== false) {
                return $valueInArrayYet;
            }

            while ($arabicNumber > 0) {
                foreach (array_reverse(self::ROMAN_VALUES) as $letter => $value) {
                    if($arabicNumber >= $value) {
                        $arabicNumber -= $value;
                        $romanNumber .= $letter;
                        break;
                    }
                }
            }

        } else {
            return null;
        }

        return $romanNumber;
    }
	
}
