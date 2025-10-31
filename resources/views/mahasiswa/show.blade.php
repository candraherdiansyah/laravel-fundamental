@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Mahasiswa') }}
                    </div>
                    <div class="float-end">
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td>{{$mahasiswa->nama}}</td>
                            </tr>
                            <tr>
                                <th>Dosen Pengampu</th>
                                <td>{{$mahasiswa->dosen->nama}}</td>
                            </tr>
                            <tr>
                                <th>Nama Wali</th>
                                <td>{{$mahasiswa->wali->nama ?? '-'}}</td>
                            </tr>
                            <tr>
                                <th>Daftar Hobi </th>
                                <td>
                                    @foreach ($mahasiswa->hobis as $hobi)
                                    <li>{{$hobi->nama_hobi}}</li>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection