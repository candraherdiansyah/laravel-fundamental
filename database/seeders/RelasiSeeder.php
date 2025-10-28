<?php
namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Wali;
// import model
use Illuminate\Database\Seeder;

class RelasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = Mahasiswa::create([
            'nama' => 'Candra Herdiansyah',
            'nim'  => '123456',
        ]);

        Wali::create([
            'nama'         => 'Pak Herdi',
            'id_mahasiswa' => $mahasiswa->id,
        ]);
    }
}
