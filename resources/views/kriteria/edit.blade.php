@extends('layouts.template')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Kriteria</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Ups!</strong> Ada beberapa masalah dengan masukan Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <div class="input-group">
                                        <input id="kode" type="text" class="form-control" placeholder="Contoh: C1" name="kode" value="{{ $kriteria->kode }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <input id="nama" type="text" class="form-control" placeholder="Gaji" name="nama" value="{{ $kriteria->nama }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tipe">Tipe</label>
                                    <select class="form-control" id="tipe" name="tipe">
                                        @if ($kriteria->tipe == "benefit")
                                        <option value="benefit" selected='selected'>Benefit</option>
                                        <option value="cost">Cost</option>
                                        @else
                                        <option value="benefit">Benefit</option>
                                        <option value="cost" selected='selected'>Cost</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <div class="input-group">
                                        <input id="bobot" type="text" class="form-control" placeholder="Contoh: 0.15" name="bobot" value="{{ $kriteria->bobot }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection