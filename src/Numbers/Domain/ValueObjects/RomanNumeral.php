<?php

namespace App\Numbers\Domain\ValueObjects;

enum RomanNumeral: string
{
    case M = 'M';
    case CM = 'CM';
    case D = 'D';
    case CD = 'CD';
    case C = 'C';
    case XC = 'XC';
    case L = 'L';
    case XL = 'XL';
    case X = 'X';
    case IX = 'IX';
    case V = 'V';
    case IV = 'IV';
    case I = 'I';
}

/*class RomanNumber
{
    private const ARABIC_VALUES = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromArabic(int $arabic): self
    {
        $roman = '';

        foreach (self::ARABIC_VALUES as $numeral => $value) {
            while ($arabic >= $value) {
                $roman .= $numeral;
                $arabic -= $value;
            }
        }

        return new self($roman);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}*/
