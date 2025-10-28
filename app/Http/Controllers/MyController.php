<?php
namespace App\Http\Controllers;

class MyController extends Controller
{
    public function hello()
    {
        $nama = "Candra";
        $umur = 27;

        return view('hello', compact('nama', 'umur'));
    }

    public function siswa()
    {
        $data = [
            ['nama' => 'Rehan', 'kelas' => 'XI RPL 3'],
            ['nama' => 'Dadan', 'kelas' => 'XI RPL 3'],
            ['nama' => 'Didin', 'kelas' => 'XI RPL 1'],
        ];

        return view('siswa', compact('data'));
    }
}
