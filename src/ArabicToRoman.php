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
     to decimal numbers ($romanToArabicEquivalences).

     SPOILER!!  This function will just work for numbers under 4000, so 3999 will be the highest possible operable
     number, which is "casually" also the highest number, I guessed this was the answer that you were waiting for.
     Nevertheless, for higher numbers we could add new key-values to our array, as also romans did; since we can't
     add lines on top of the roman numbers, we would use the low bar ---> _I; _V; _X; _L; _C; _D; & _M (1 million).
     */
    public static function transform(int $arabicNumber): string
    {
        $romanToArabicEquivalences = [
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

            if($arabicNumber <= 0) return '';

            //I copy the arabic number in a new variable to iterate with, and avoid modifying the function's parameter
            $arabicNumberToConvert = $arabicNumber;

            //Here I had a little dilema about using foreach or a map (array_map in this case), I decided that the map
            //function was more readable (later I read an article speaking of the potentially faster performance of a 
            //map vs foreach and I had enough arguments to justify my decision) || use to get equivalences and the arabicNum
            $romanNumber = array_map(function ($key) use ($romanToArabicEquivalences, &$arabicNumberToConvert) {
                $romanNumberValue = $romanToArabicEquivalences[$key];
                //Calculating number of times the romanNumber is repeated
                $timesToRepeat = floor($arabicNumberToConvert / $romanNumberValue);
                //Update the number and get the remainder after the romanNumber has been added
                $arabicNumberToConvert %= $romanNumberValue;
                //Repeat the roman number x $timesToRepeat
                return str_repeat($key, $timesToRepeat);
            }, array_keys($romanToArabicEquivalences));
            
          
            //As we actually have an array of romanNumbers, we convert it to a string with the implode function
            //the first argument is the space in between each element, none in our scenario (""), the second argument
            //is the proper array we want to convert to string
            return implode("", $romanNumber);
    }
}

