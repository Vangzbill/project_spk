@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               
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
                                            
                                                <h2 class="m-0">Perankingan</h2>
                                            
                                            <table id="rankingTable" class="display nowrap table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Ranking</th>
                                                        <th>Alternatif</th>
                                                        <th>Yi Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hitungYi as $alternatifId => $alternatifData)
                                                        <tr>
                                                            <td>{{ $alternatifData['ranking'] }}</td>
                                                            <td>{{ $alternatif->where('id', $alternatifId)->first->nama['nama'] }}</td>
                                                            <td>
                                                                @if (isset($alternatifData['yiValue']))
                                                                    {{ $alternatifData['yiValue'] }}
                                                                @endif
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
        $('#rankingTable').DataTable({
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
