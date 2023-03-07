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

     /*
     There are different ways of approaching this problem, we could do it by creating a higher level function
     that uses different functions to get the final roman number (getRomanHundred, getRomanThousand ...).
     But this approach was too long and filled with conditionals, that even if converting them to ternary operators
     would have been tedious and unnecesary long.
     That brings me to the final approach where I used an associative array that contains the equivalences of roman
     to decimal numbers ($romanToDecimalEquivalences).

     SPOILER!!  This function will just work for numbers under 4000, so 3999 will be the highest possible operable
     number, which is "casually" also the highest number, I guessed this was the answer that you were waiting for.
     Nevertheless, for higher numbers we could add new key-values to our array, as also romans did; since we can't
     add lines on top of the roman numbers, we would use the low bar ---> _I; _V; _X; _L; _C; _D; & _M (1 million).
     */
    public static function transform(int $arabicNumber): string
    {
        $romanToDecimalEquivalences = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

            $numberToConvert = $arabicNumber;

            

           /*  $letters = array_map(function ($key) use ($romanToDecimalEquivalences, &$numberToConvert) ) */
    }
}

/*  $romanToDecimalEquivalences = ['I' => 1, 'IV' => 4, 'V' => 5, 'IX' => 9, 'X' => 10, 'XL' => 40, 'L' => 50, 'XC' => 90, 'C' => 100, 'CD' => 400, 'D' => 500, 'CM' => 900, 'M' => 1000]
         */

/*
This was my first aproach to the function, but since it was full of conditionals and it's too long I've taken a different approach more simple and compact
 using an array of equivalences.


function getFinalDecimalToRoman($num) {
    $romanNumber = '';

    $romanNumber .= thousands($num);
    $num = $num % 1000;

    $romanNumber .= hundreds($num);
    $num = $num % 100;

    $romanNumber .= tens($num);
    $num = $num % 10;

    $romanNumber .= ones($num);

    return $romanNumber;
  }

  function getRomanThousands($num) {
    $result = '';

    while ($num >= 1000) {
      $result .= 'M';
      $num -= 1000;
    }

    return $result;
  }

  function getRomanHundreds($num) {
    if ($num >= 900) {
      return 'CM' . hundreds($num - 900);
    } else if ($num >= 500) {
      return 'D' . hundreds($num - 500);
    } else if ($num >= 400) {
      return 'CD' . hundreds($num - 400);
    } else if ($num >= 100) {
      return 'C' . hundreds($num - 100);
    } else {
      return '';
    }
  }

  function getRomanTens($num) {
    if ($num >= 90) {
      return 'XC' . tens($num - 90);
    } else if ($num >= 50) {
      return 'L' . tens($num - 50);
    } else if ($num >= 40) {
      return 'XL' . tens($num - 40);
    } else if ($num >= 10) {
      return 'X' . tens($num - 10);
    } else {
      return '';
    }
  }

  function getRomanOnes($num) {
    if ($num >= 9) {
      return 'IX' . ones($num - 9);
    } else if ($num >= 5) {
      return 'V' . ones($num - 5);
    } else if ($num >= 4) {
      return 'IV' . ones($num - 4);
    } else if ($num >= 1) {
      return 'I' . ones($num - 1);
    } else {
      return '';
    }
  }

return $romanNumber; */
