@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Edit Data Mahasiswa</div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.update',$mahasiswa->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="">Nama Mahasiswa</label>
                            <input type="text" name="nama" value="{{ $mahasiswa->nama }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Induk Mahasiswa</label>
                            <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="form-control
                            @error('nim') is-invalid @enderror">
                            @error('nim')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select name="id_dosen" class="form-control
                            @error('id_dosen') is-invalid @enderror">
                                @foreach ($dosen as $data)
                                <option value="{{ $data->id }}" {{ $data->id == $mahasiswa->id_dosen ? 'selected' :''}}>
                                    {{$data->nama}}
                                </option>
                                @endforeach
                            </select>
                            @error('id_dosen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Pilih Hobi</label>
                            <select name="hobi[]" id="" class="form-control js-multiple" multiple>
                                @foreach ($hobi as $data)
                                <option value="{{ $data->id }}" {{ in_array($data->id,
                                    $mahasiswa->hobis->pluck('id')->toArray()) ? 'selected' : ''
                                    }}>
                                    {{$data->nama_hobi}}
                                </option>
                                @endforeach
                            </select>
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