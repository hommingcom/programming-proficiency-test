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
        // Complete the function
        if($arabicNumber>0){
            $arabicNumberMutable=$arabicNumber;     // creo un valor mutable para no modificar el valor original
            $numberDictorionary=[                   // diccionario de valor-letras para numeros romanos
                1000=>['M'],
                900=>['CM'],
                500=>['D'],
                400=>['CD'],
                100=>['C'],
                90=>['XC'],
                50=>['L'],
                40=>['XL'],
                10=>['X'],
                9=>['IX'],
                5=>['V'],
                4=>['IV'],
                1=>['I']
            ];
            foreach($numberDictorionary as $number=>$value){
                $times=intdiv($arabicNumberMutable,$number); //cuantas veces se va a repetir la letra
                if($times<=3){
                    $arabicNumberMutable=$arabicNumberMutable%$number; 
                    $romanNumber.=str_repeat($value[0],$times);        
                }
            }
        }
        return $romanNumber;
    }
}