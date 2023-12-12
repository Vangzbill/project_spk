@extends('layouts.template')
@section('content')
<br><br><br>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: white; margin-left:15px">Tambah Kriteria Baru</h1>
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
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h2 class="card-title" style="color: white">Kriteria dan Bobot</h2>
                                        </div>
                                    </div>
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
                                            <div class="card bg-info">
                                                <div class="card-body">
                                                    <form action="{{ route('kriteria.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="kode">Kode</label>
                                                            <div class="input-group">
                                                                <input id="kode" type="text" class="form-control" placeholder="Contoh: C1" name="kode" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <div class="input-group">
                                                                <input id="nama" type="text" class="form-control" placeholder="Gaji" name="nama" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipe">Tipe</label>
                                                            <select class="form-control" id="tipe" name="tipe">
                                                                <option value="benefit">Benefit</option>
                                                                <option value="cost">Cost</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bobot">Bobot</label>
                                                            <div class="input-group">
                                                                <input id="bobot" type="text" class="form-control" placeholder="Contoh: 0.15" name="bobot" required>
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
    </div>
@endsection
@section('script')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        $('#mytable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection