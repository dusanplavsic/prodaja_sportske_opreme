<?php

namespace Database\Factories;

use App\Models\Porudzbine;
use App\Models\Proizvodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkePorudzbineFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'porudzbina_id' => Porudzbine::factory(),
            'proizvod_id' => Proizvodi::factory(),
            'kolicina' => fake()->numberBetween(-10000, 10000),
            'cena_po_komadu' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
