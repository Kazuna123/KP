<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PencatatanTanggal>
 */
class PencatatanTanggalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'catatan' => $this->faker->optional()->sentence(),
            // 'transaksi_id' diberikan saat dipanggil di seeder
        ];
    }
}
