@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kriteria & Bobot</h1>
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
                                            @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                            <a href="{{route('kriteria.create')}}" class='btn btn-primary'>
                                                <span class='fa fa-plus'></span> Tambah Kriteria
                                            </a>
                                            <br>
                                            <table id="mytable" class="display nowrap table table-striped table-bordered" style="background-color: white">
                                                <thead>
                                                    <tr style="background-color: #374f80; color:white;">
                                                        <th>No</th>
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Tipe</th>
                                                        <th>Bobot</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kriteria as $c)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td>{{ $c->kode}}</td>
                                                        <td>{{ $c->nama}}</td>
                                                        <td>{{ $c->tipe}}</td>
                                                        <td>{{ $c->bobot}}</td>
                                                        <td>
                                                            <form action="{{ route('kriteria.destroy',$c->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <span data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                                                                    <a href="{{ route('kriteria.edit',$c->id) }}"
                                                                        class="btn btn-primary"><span class="fa fa-edit"></span>
                                                                    </a>
                                                                </span>
                                                                <span data-toggle="tooltip" data-placement="bottom" title="Hapus Data">
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <span class="fa fa-trash"></span>
                                                                    </button>
                                                                </span>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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