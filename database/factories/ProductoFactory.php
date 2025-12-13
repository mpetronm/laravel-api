<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'descripcion' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}