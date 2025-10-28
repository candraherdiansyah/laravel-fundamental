<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;

class RelasiController extends Controller
{
    public function oneToOne()
    {
        $mahasiswas = Mahasiswa::with('wali')->get();
        // dd($mahasiswas);
        return view('relasi.one_to_one', compact('mahasiswas'));
    }

    public function oneToMany()
    {
        // Ambil dosen beserta mahasiswa bimbingannya
        $dosens = Dosen::with('mahasiswas')->get();
        // dd($dosens);
        return view('relasi.one_to_many', compact('dosens'));
    }

    public function manyToMany()
    {
        $mahasiswas = Mahasiswa::with('hobis')->get();
        return view('relasi.many_to_many', compact('mahasiswas'));
    }

    public function eloquent()
    {
        // Ambil semua data mahasiswa lengkap dengan relasinya
        $mahasiswa = Mahasiswa::with('wali', 'dosen', 'hobis')->get();

        // Kirim data ke view
        return view('relasi.eloquent', compact('mahasiswa'));
    }

}
