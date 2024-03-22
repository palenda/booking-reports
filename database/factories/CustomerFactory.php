<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
