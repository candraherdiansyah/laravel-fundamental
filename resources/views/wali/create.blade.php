@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Tambah Data Wali</div>
                <div class="card-body">
                    <form action="{{ route('wali.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Nama Wali</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="id_mahasiswa" class="form-control
                            @error('id_mahasiswa') is-invalid @enderror">
                                @foreach ($mahasiswa as $data)
                                <option value="{{ $data->id }}">{{$data->nama}}</option>
                                @endforeach
                            </select>
                            @error('id_mahasiswa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
