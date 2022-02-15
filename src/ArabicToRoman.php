<?php

namespace App;

use App\Classes\ArabicToRomanDM;

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
        // Data manger to handle de logic 
        $arabicToRoman_DM = new ArabicToRomanDM();
        
        // Return de equal value in Roman
        return $arabicToRoman_DM->convert($arabicNumber);
    }
}