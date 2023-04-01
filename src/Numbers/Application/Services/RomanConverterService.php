<?php

namespace App\Numbers\Application\Services;

use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;
use App\Numbers\Domain\Entities\RomanNumber;
use App\Numbers\Domain\Exceptions\DomainException;

final class RomanConverterService implements RomanConverterServiceInterface {
    /**
     * @throws DomainException
     */
    public function convertArabicToRoman(int $arabicNumber): string
    {
        $romanNumber = RomanNumber::fromArabic($arabicNumber);
        return (string) $romanNumber;
    }
}