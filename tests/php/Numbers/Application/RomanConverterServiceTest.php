<?php

namespace Tests\Numbers\Application;

use App\Numbers\Application\Exceptions\ApplicationException;
use App\Numbers\Domain\Exceptions\DomainException;
use App\Numbers\Application\Services\{RomanConverterService};
use PHPUnit\Framework\TestCase;

class RomanConverterServiceTest extends TestCase
{
    private RomanConverterService $romanConverterService;

    protected function setUp(): void
    {
        $this->romanConverterService = new RomanConverterService();
    }

    /**
     * @throws DomainException
     */
    public function test_convert_arabic_to_roman(): void
    {
        $expectedResult = 'III';
        $arabicNumber = 3;

        $result = $this->romanConverterService->convertArabicToRoman($arabicNumber);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_convert_arabic_to_roman_throws_exception(): void
    {
        $this->expectException(DomainException::class);
        $arabicNumber = -1;

        $this->romanConverterService->convertArabicToRoman($arabicNumber);
    }
}