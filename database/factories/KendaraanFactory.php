<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_polisi' => strtoupper($this->faker->unique()->bothify('N??-####-??')),
            'merk' => $this->faker->randomElement(['Toyota', 'Isuzu', 'Mitsubishi', 'Suzuki', 'Daihatsu']),
            'tipe' => $this->faker->word(),
            'tahun' => $this->faker->numberBetween(2005, 2023),
            'status' => $this->faker->randomElement(['tersedia','dipinjam','maintenance']),
        ];
    }
}
