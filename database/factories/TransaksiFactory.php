<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pegawai;
use App\Models\Kendaraan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pegawai_id' => Pegawai::factory(), // will create pegawai if none
            'kendaraan_id' => Kendaraan::factory(), // will create kendaraan if none
            'jenis' => $this->faker->randomElement(['pinjam', 'servis']),
            'tujuan' => $this->faker->randomElement(['Urusan dinas', 'Monitoring jalan', 'Rapat', 'Perbaikan jembatan']),
            'tanggal_mulai' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'tanggal_selesai' => null,
            'status' => $this->faker->randomElement(['ongoing','selesai','dibatalkan']),
            'keterangan' => $this->faker->optional()->sentence(),x
        ];
    }
}
