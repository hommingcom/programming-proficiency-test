<?php

namespace App\Numbers\Application\Services;

use App\Numbers\Application\Exceptions\ApplicationException;
use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;
use App\Numbers\Domain\Exceptions\DomainException;
use App\Numbers\Domain\ValueObjects\RomanNumber;

final class RomanConverterService implements RomanConverterServiceInterface {
    /**
     * @throws ApplicationException
     */
    public function convertArabicToRoman(int $arabicNumber): string
    {
        try {
            $romanNumber = RomanNumber::fromArabic($arabicNumber);
        } catch (DomainException $e) {
            throw new ApplicationException($e->getMessage(), $e->getCode(), $e);
        }

        return (string)$romanNumber;
    }
}