<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KupciFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->regexify('[A-Za-z0-9]{50}'),
            'prezime' => fake()->regexify('[A-Za-z0-9]{50}'),
            'email' => fake()->safeEmail(),
            'telefon' => fake()->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
