@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Relasi One to Many (Dosen - Mahasiswa)</h3>

    @foreach($dosens as $dosen)
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>{{ $dosen->nama }}</strong> (NIPD: {{ $dosen->nipd }})
        </div>
        <div class="card-body">
            <h6>Daftar Mahasiswa Bimbingan:</h6>
            <ul class="list-group list-group-flush">
                @forelse($dosen->mahasiswas as $mhs)
                <li class="list-group-item">{{ $mhs->nama }} ({{ $mhs->nim }})</li>
                @empty
                <li class="list-group-item text-muted">Belum ada mahasiswa</li>
                @endforelse
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection
