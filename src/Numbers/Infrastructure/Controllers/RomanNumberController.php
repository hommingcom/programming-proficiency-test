<?php

namespace App\Numbers\Infrastructure\Controllers;

use App\Numbers\Application\Exceptions\ApplicationException;
use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;

final readonly class RomanNumberController {

    public function __construct(
        private RomanConverterServiceInterface $romanConverterService
    ){}

    /**
     * @throws ApplicationException
     */
    public function convert(int $arabicNumber): string
    {
        // convert arabic numeral to roman numeral using the service
        return $this->romanConverterService->convertArabicToRoman($arabicNumber);
    }
}
