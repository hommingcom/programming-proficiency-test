<?php

namespace Tests\Numbers\Domain;

use App\Numbers\Domain\Exceptions\DomainException;
use App\Numbers\Domain\ValueObjects\RomanNumber;
use PHPUnit\Framework\TestCase;

class RomanNumberTest extends TestCase
{
    /**
     * @throws DomainException
     */
    public function test_can_be_created_from_arabic()
    {
        $romanNumber = RomanNumber::fromArabic(1);
        $this->assertInstanceOf(RomanNumber::class, $romanNumber);
        $this->assertEquals('I', (string) $romanNumber);

        $romanNumber = RomanNumber::fromArabic(3999);
        $this->assertInstanceOf(RomanNumber::class, $romanNumber);
        $this->assertEquals('MMMCMXCIX', (string) $romanNumber);
    }

    public function test_throws_exception_for_invalid_arabic_number()
    {
        $this->expectException(DomainException::class);
        RomanNumber::fromArabic(0);
    }

    public function test_throws_exception_for_arabic_number_greater_than_3999()
    {
        $this->expectException(DomainException::class);
        RomanNumber::fromArabic(4000);
    }
}