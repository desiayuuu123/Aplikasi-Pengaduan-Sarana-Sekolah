<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;
use App\Models\Siswa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPengaduan>
 */
class LaporanPengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::factory(),
            'kategori_id' => Kategori::factory(),
            'ket' => $this->faker->sentence(12),
            'lokasi' => $this->faker->randomElement([
                'Ruang Kelas',
                'Laboratorium',
                'Perpustakaan',
                'Toilet',
                'Lapangan',
            ]),
        ];
    }
}
