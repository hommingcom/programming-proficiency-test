<?php

namespace App\Numbers\Infrastructure\Controllers;

use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;
use App\Numbers\Infrastructure\Interfaces\RomanNumberControllerInterface;

final readonly class RomanNumberController implements RomanNumberControllerInterface {

    public function __construct(private RomanConverterServiceInterface $romanConverterService)
    {}

    public function convert(?int $arabicNumber = null): string
    {
        if (is_null($arabicNumber)) {
            $arabicNumber = $_REQUEST['arabic_number'];
        }

        // convert arabic numeral to roman numeral using the service
        return $this->romanConverterService->convertArabicToRoman($arabicNumber);
    }
}
