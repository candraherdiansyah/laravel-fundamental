<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Wali;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function index()
    {
        $walis = wali::latest()->get();
        return view('wali.index', compact('walis'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        return view('wali.create', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required',
            'id_mahasiswa' => 'required|exists:mahasiswas,id|unique:walis,id_mahasiswa',
        ]);

        $wali               = new wali();
        $wali->nama         = $request->nama;
        $wali->id_mahasiswa = $request->id_mahasiswa;
        $wali->save();
        return redirect()->route('wali.index');

    }

    public function show(string $id)
    {
        $wali = wali::findOrFail($id);
        return view('wali.show', compact('wali'));
    }

    public function edit(string $id)
    {
        $wali      = wali::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        return view('wali.edit', compact('wali', 'mahasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'         => 'required',
            'nim'          => 'required|unique:walis',
            'id_mahasiswa' => 'required|exists:mahasiswas,id|unique:walis,id_dosen',
        ]);

        $wali               = wali::findOrFail($id);
        $wali->nama         = $request->nama;
        $wali->id_mahasiswa = $request->id_mahasiswa;
        $wali->save();
        return redirect()->route('wali.index');
    }

    public function destroy(string $id)
    {
        $wali = wali::findOrFail($id);
        $wali->delete();
        return redirect()->route('wali.index');

    }
}
