<?php

namespace App\Bakery\Domain\Entities;

final readonly class Recipe
{

    public function __construct(
        private string $name,
        private array $ingredients,
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}