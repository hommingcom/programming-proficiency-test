<?php

namespace App\Numbers\Domain\ValueObjects;

use App\Numbers\Domain\Exceptions\DomainException;

final class RomanNumber {

    private const ROMAN_NUMERALS = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    public function __construct(private readonly string $romanNumber)
    {}

    /**
     * @throws DomainException
     */
    public static function fromArabic(int $arabicNumber): RomanNumber
    {
        if ($arabicNumber < 1 || $arabicNumber > 3999) {
            throw new DomainException('The Arabic number must be between 1 and 3999');
        }

        $romanNumber = '';
        foreach (self::ROMAN_NUMERALS as $value => $numeral) {
            while ($arabicNumber >= $value) {
                $romanNumber .= $numeral;
                $arabicNumber -= $value;
            }
        }

        return new self($romanNumber);
    }

    public function __toString(): string {
        return $this->romanNumber;
    }
}
