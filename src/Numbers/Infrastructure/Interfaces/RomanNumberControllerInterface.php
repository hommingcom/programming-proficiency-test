<?php

namespace App\Numbers\Infrastructure\Interfaces;

interface RomanNumberControllerInterface
{
    public function convert(?int $arabicNumber): string;
}