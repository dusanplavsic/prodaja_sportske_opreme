<?php

namespace Database\Factories;

use App\Models\Kategorije;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProizvodiFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->word(),
            'opis' => fake()->text(),
            'cena' => fake()->numberBetween(-10000, 10000),
            'kolicina_na_stanju' => fake()->numberBetween(-10000, 10000),
            'kategorija_id' => Kategorije::factory(),
        ];
    }
}
