@extends('layouts.template')

@section('content')
<br><br><br>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: white; margin-left:15px">Tambah Alternatif</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-left: 15px">
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list">
                            <div class="row">
                                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                    
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
                                            <form action="{{route('alternatif.store')}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="kode" style="color: white">Kode</label>
                                                    <div class="input-group">
                                                        <input id="kode" type="text" class="form-control" placeholder="Contoh: C1" name="kode" style="border: 2px solid white" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" style="color: white">Nama</label>
                                                    <div class="input-group">
                                                        <input id="nama" type="text" class="form-control" placeholder="Somat S, Pd." name="nama" style="border: 2px solid white" required>
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
            </div>
        </div>
    </div>
</div>
@endsection