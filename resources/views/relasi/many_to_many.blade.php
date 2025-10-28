@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Relasi Many to Many (Mahasiswa - Hobi)</h3>

    <div class="row">
        @foreach($mahasiswas as $mhs)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong>{{ $mhs->nama }}</strong> ({{ $mhs->nim }})
                </div>
                <div class="card-body">
                    <h6>Daftar Hobi:</h6>
                    @if($mhs->hobis->isEmpty())
                    <p class="text-muted">Belum punya hobi</p>
                    @else
                    <ul class="list-group list-group-flush">
                        @foreach($mhs->hobis as $hobi)
                        <li class="list-group-item">{{ $hobi->nama_hobi }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
