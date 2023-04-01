<?php

namespace App\Numbers\Domain\Interfaces;

interface RomanConverterInterface
{
    public function convert(int $arabicNumber): string;
}