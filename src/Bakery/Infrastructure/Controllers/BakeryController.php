<?php

namespace App\Bakery\Infrastructure\Controllers;

use App\Bakery\Application\Services\BakeryService;

final readonly class BakeryController
{

    public function __construct(private BakeryService $bakeryService)
    {}

    public function calculateOutput(string $recipeName, array $ingredients): int
    {
        return $this->bakeryService->calculateOutput($recipeName, $ingredients);
    }
}