<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\LaporanPengaduan;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = Admin::factory()->create([
            'nama' => 'Administrator',
            'username' => 'admin',
        ]);
        $kategori = Kategori::factory()->count(5)->create();
        $siswa = Siswa::factory()->count(10)->create();
        $laporan = LaporanPengaduan::factory()
             ->count(15)
             ->make ()
        ->each(function ($laporan) use ($siswa, $kategori) {
            $laporan->siswa_id = $siswa->random()->id;
            $laporan->kategori_id = $kategori->random()->id;
            $laporan->save();
        });

        $laporan->each(function ($laporan) use ($admin) {
            Aspirasi::factory()->create([
                'laporan_id' => $laporan->id,
                'admin_id' => $admin->id,
            ]);
        });
    }
}
