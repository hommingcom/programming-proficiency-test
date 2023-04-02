<?php

namespace App\Numbers\Application\Interfaces;

use App\Numbers\Application\Exceptions\ApplicationException;

interface RomanConverterServiceInterface
{
    /**
     * @throws ApplicationException
     */
    public function convertArabicToRoman(int $arabicNumber): string;
}