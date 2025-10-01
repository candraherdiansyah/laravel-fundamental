<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// import package
use DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hapus data awal
        DB::table('posts')->delete();

        // buat sample data baru
        $post = [
            ['title' => 'Belajar Laravel', 'content'=>'Lorem Ipsum'],
            ['title'=> 'Tips Belajar Laravel', 'content'=>'Lorem Ipsum'],
            ['title'=> 'Jadwal Latihan Workout Bulanan', 'content'=>'Lorem Ipsum']
        ];

        DB::table('posts')->insert($post);
    }
}
