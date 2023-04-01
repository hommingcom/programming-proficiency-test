<?php

namespace App\Numbers\Domain\Interfaces;

interface RomanNumberInterface
{
    public static function fromArabic(int $arabicNumber): RomanNumberInterface;
    public function __toString(): string;
}