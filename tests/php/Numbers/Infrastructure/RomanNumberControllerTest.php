<?php

namespace Tests\Numbers\Infrastructure;

use App\Numbers\Application\Interfaces\RomanConverterServiceInterface;
use App\Numbers\Infrastructure\Controllers\RomanNumberController;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;



class RomanNumberControllerTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function test_convert_arabic_to_roman()
    {
        // Create a mock RomanConverterService
        $romanConverterService = $this->getMockBuilder(RomanConverterServiceInterface::class)
            ->getMock();

        // Set up the mock to return 'I' for 1 and 'II' for 2
        $romanConverterService->method('convertArabicToRoman')
            ->willReturnMap([
                [1, 'I'],
                [2, 'II'],
            ]);

        // Create a RomanNumberController with the mock service
        $controller = new RomanNumberController($romanConverterService);

        // Check that converting 1 returns I
        $result = $controller->convert(1);
        $this->assertEquals('I', $result);

        // Check that converting 2 returns II
        $result = $controller->convert(2);
        $this->assertEquals('II', $result);

        // Check that converting 2 does not return I
        $result = $controller->convert(2);
        $this->assertNotEquals('I', $result);
    }
}