<?php

namespace App\Numbers\Application\Interfaces;

interface RomanConverterServiceInterface
{
    public function convertArabicToRoman(int $arabicNumber): string;
}