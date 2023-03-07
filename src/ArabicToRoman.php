<?php

namespace App;

use ArrayIterator;

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

        $map = [
            1000    => 'M',
            900     => 'CM',
            500     => 'D',
            400     => 'CD',
            100     => 'C',
            90      => 'XC',
            50      => 'L',
            40      => 'XL',
            10      => 'X',
            9       => 'IX',
            5       => 'V',
            4       => 'IV',
            1       => 'I',
        ];

        $iterator = new ArrayIterator($map);
        while($iterator->valid()){
            $key = $iterator->key();
            while($arabicNumber >= $key){
                $romanNumber .= $iterator->current();
                $arabicNumber -= $key;
            }
            $iterator->next();
        }

        return $romanNumber;
    }
}