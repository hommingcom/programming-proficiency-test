<?php

namespace App;

class ArabicToRoman
{
    CONST NUMBER_EQUIVALENCES = [
        'M'=>1000,
        'D'=>500,
        'C'=>100,
        'L'=>50,
        'X'=>10,
        'V'=>5,
        'I'=>1
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
        $romanNumber = '';

        // Complete the function
        $previousValueRoman = null;
        $previousValueInteger = 0;
        $previousIsNeeded = false;
        foreach (self::NUMBER_EQUIVALENCES as $romanCharacter=>$arabicEquivalenceNumber){
            if(self::checkIfPreviousIsNeeded($arabicNumber, $previousValueInteger,$romanCharacter,$previousIsNeeded)){
                $previousIsNeeded = true;
            }
            else{
                $result = floor($arabicNumber / $arabicEquivalenceNumber);
                if($result > 0){
                    $arabicNumber -= $arabicEquivalenceNumber * $result ;
                    $romanNumber .= self::getRomanNumber($previousValueRoman,$romanCharacter,$result);
                }
                $previousValueRoman = $romanCharacter;
                $previousValueInteger = $arabicEquivalenceNumber;
                $previousIsNeeded = false;
            }

        }

        return $romanNumber;
    }

    private static function checkIfPreviousIsNeeded(int $arabicNumber,int $integerValue,String $key,bool $previousIsNeeded):bool
    {
        if(
            ($arabicNumber + 1 == $integerValue || $arabicNumber + 2 == $integerValue)
            && !$previousIsNeeded
            && $key != array_key_last(self::NUMBER_EQUIVALENCES)) return true;
        return false;
    }

    private static function getRomanNumber(String|null $previousValueRoman, String $romanCharacter,int $result):String
    {
        $romanNumber = '';
        if($result < 4){
            $romanNumber .= str_repeat($romanCharacter,$result);
        }
        else{
            $romanNumber .= $romanCharacter.$previousValueRoman;
        }
        return $romanNumber;
    }

}