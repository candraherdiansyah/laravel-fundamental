<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hobi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        $hobi  = Hobi::all();
        return view('mahasiswa.create', compact('dosen', 'hobi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required',
            'nim'      => 'required|unique:mahasiswas',
            'id_dosen' => 'required|exists:dosens,id',
        ]);

        $mahasiswa           = new Mahasiswa();
        $mahasiswa->nama     = $request->nama;
        $mahasiswa->nim      = $request->nim;
        $mahasiswa->id_dosen = $request->id_dosen;
        $mahasiswa->save();
        // attach (melampirkan banyak data atau many to many)
        $mahasiswa->hobis()->attach($request->hobi);
        return redirect()->route('mahasiswa.index');

    }

    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $dosen     = Dosen::all();
        $hobi      = Hobi::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosen', 'hobi'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'     => 'required',
            'nim'      => 'required|',
            'id_dosen' => 'required|exists:dosens,id',
        ]);

        $mahasiswa           = Mahasiswa::findOrFail($id);
        $mahasiswa->nama     = $request->nama;
        $mahasiswa->nim      = $request->nim;
        $mahasiswa->id_dosen = $request->id_dosen;
        $mahasiswa->save();
        // sync (memperbarui data yang diubah dari many to many)
        $mahasiswa->hobis()->sync($request->hobi);

        return redirect()->route('mahasiswa.index');
    }

    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        // detach (menghapus data yang terkait dari mahasiswa dan hobi)
        // menghapu data di relasi table pivot
        $mahasiswa->hobis()->detach();
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index');

    }
}
