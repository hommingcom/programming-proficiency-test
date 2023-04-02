<?php

namespace App\Bakery\Domain\DTO;

final class RecipeDTO
{

    public function __construct(
        public string $name,
        public array $ingredients
    ){}
}