<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // pemanggilan class sample data
        $this->call([
            // PostTableSeeder::class,
            DosenMahasiswaSeeder::class,
            HobiSeeder::class,
            // MahasiswaSeeder::class,
            RelasiSeeder::class,
        ]);
    }
}
