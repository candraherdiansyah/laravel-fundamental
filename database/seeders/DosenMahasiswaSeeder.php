<?php
namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen1 = Dosen::create([
            'nama' => 'Dr. Andi Nugraha',
            'nipd' => 'D001',
        ]);

        $dosen2 = Dosen::create([
            'nama' => 'Prof. Siti Rahmawati',
            'nipd' => 'D002',
        ]);

        // Tambahkan mahasiswa ke masing-masing dosen
        $dosen1->mahasiswas()->createMany([
            ['nama' => 'Candra Herdiansyah', 'nim' => '123456'],
            ['nama' => 'Rizky Ramadhan', 'nim' => '123457'],
        ]);

        $dosen2->mahasiswas()->createMany([
            ['nama' => 'Nur Aisyah', 'nim' => '123458'],
            ['nama' => 'Dewi Pertiwi', 'nim' => '123459'],
        ]);
    }
}
