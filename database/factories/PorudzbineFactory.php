<?php

namespace Database\Factories;

use App\Models\Kupci;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorudzbineFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kupac_id' => Kupci::factory(),
            'datum_porudzbine' => fake()->date(),
            'status' => fake()->text(),
            'ukupan_iznos' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
