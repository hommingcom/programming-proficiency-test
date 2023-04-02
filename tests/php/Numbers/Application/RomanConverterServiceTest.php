<?php

namespace Tests\Numbers\Application;

use App\Numbers\Application\Exceptions\ApplicationException;
use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;
use App\Numbers\Application\Services\RomanConverterService;
use PHPUnit\Framework\TestCase;

class RomanConverterServiceTest extends TestCase
{
    private RomanConverterServiceInterface $romanConverterService;

    protected function setUp(): void
    {
        $this->romanConverterService = new RomanConverterService();
    }

    /**
     * @throws ApplicationException
     */
    public function test_convert_arabic_to_roman(): void
    {
        $expectedResult = 'III';
        $arabicNumber = 3;

        $result = $this->romanConverterService->convertArabicToRoman($arabicNumber);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @throws ApplicationException
     */
    public function test_convert_arabic_to_roman_throws_exception(): void
    {
        $this->expectException(ApplicationException::class);
        $arabicNumber = -1;

        $this->romanConverterService->convertArabicToRoman($arabicNumber);
    }
}
