<?php

namespace App\Classes;

class ArabicToRomanDM
{
    // Arabic to Roman dictionary 
    protected $dictionary = array(
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
        1 => 'I',
    );

    /**
     * Parse the Arabic number to Roman
     *
     * @param int $arabicNumber number to convert 
     *
     * @return string Roman number
     */
    public function convert($arabicNumber): string
    {
        $result = '';

        foreach($this->dictionary as $maxValue => $romanNumber){
            while ($arabicNumber >= $maxValue) {
                $result .= $romanNumber;
                $arabicNumber -= $maxValue;
            }
        }

        return $result;
    }

}