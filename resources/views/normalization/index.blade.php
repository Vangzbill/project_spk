@extends('layouts.template')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Normalisasi</h1>
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
                                            <h2 class="card-title" style="color: white">Normalisasi</h2>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">    
                                            <table id="mytable" class="display nowrap table table-striped table-bordered" style="background-color:white">
                                                <thead>
                                                    <tr style="background-color: #374f80; color:white;">
                                                        <th>Alternatif</th>
                                                        @foreach ($kriteria as $c)
                                                            <th>{{$c->kode}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alternatif as $a)
                                                    <tr>
                                                        <td>{{$a->kode}}</td>
                                                        @foreach ($normalizedScores[$a->id] as $normalizedScore)
                                                            <td>{{ $normalizedScore }}</td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="card" style="margin-top:50px;">
                                        <div class="card-body">
                                            <h2 class="m-0" style="color: white;">Optimasi</h2>
                                            <table id="mytable" class="display nowrap table table-striped table-bordered" style="background-color:white">
                                                <thead>
                                                    <tr style="background-color: #374f80; color:white;">
                                                      
                                                        <th>Alternatif</th>
                                                        @foreach ($kriteria as $k)
                                                            <th>{{$k->kode}}</th>
                                                        @endforeach
                                                        <th>Hasil</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alternatif as $al)
                                                    <tr>
                                                       
                                                        <td>{{$al->kode}}</td>
                                                        @foreach ($optimizationResults[$al->id] as $result)
                                                            <td>{{ $result }}</td>
                                                        @endforeach
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