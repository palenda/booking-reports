<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
        ];
    }
}
