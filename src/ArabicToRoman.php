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

        $romanSimbols = [
            1000 => 'M',
            900 => 'CM',
            800 => 'DCCC',
            700 => 'DCC',
            600 => 'DC',
            500 => 'D',
            400 => 'CD',
            300 => 'CCC',
            200 => 'CC',
            100 => 'C',
            90 => 'XC',
            80 => 'LXXX',
            70 => 'LXX',
            60 => 'LX',
            50 => 'L',
            40 => 'XL',
            30 => 'XXX',
            20 => 'XX',
            10 => 'X',
            9 => 'IX',
            8 => 'VIII',
            7 => 'VII',
            6 => 'VI',
            5 => 'V',
            4 => 'IV',
            3 => 'III',
            2 => 'II',
            1 => 'I',
        ];

        forEach ($romanSimbols as $arabic => $roman) { // en clave - valor, $arabic seria la clave, $roman el valor.
            while ($arabicNumber >= $arabic) {
                $romanNumber .= $roman;
                $arabicNumber -= $arabic;
            }
        }

        // Complete the function

        return $romanNumber;
    }
}


