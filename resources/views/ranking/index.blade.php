@extends('layouts.template')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ranking</h1>
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
                                        <div class="d-flex justify-content-between" style="margin-bottom: 25px">
                                            <h2 class="card-title" style="color: white">Perangkingan</h2>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            
                                            <table id="rankingTable" class="display nowrap table table-striped table-bordered" style="background-color: white">
                                                <thead>
                                                    <tr style="background-color: #374f80; color:white;">
                                                        <th>Ranking</th>
                                                        <th>Kode</th>
                                                        <th>Alternatif</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hitungYi as $alternatifId => $alternatifData)
                                                        <tr>
                                                            <td>{{ $alternatifData['ranking'] }}</td>
                                                            <td>{{ $alternatif->where('id', $alternatifId)->first->kode['kode'] }}</td>
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
<style>
    /* Ganti warna font pada lengthMenu menjadi putih */
    .dataTables_length,
    .dataTables_length label {
        color: white;
    }
    /* Ganti warna font pada elemen searching menjadi putih */
    .dataTables_filter label,
    .dataTables_filter input {
        color: white;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var rankingTable = document.getElementById("rankingTable");
    
    if (rankingTable) {
        // Initialize DataTable
        var dataTable = new DataTable(rankingTable, {
            responsive: true,
            lengthChange: true,
            lengthMenu: [5, 10, 20, 50, 100],
            pageLength: 20,
            autoWidth: false,
            searching: true,
        });

        // Add DataTable buttons
        var buttonsContainer = document.createElement("div");
        buttonsContainer.className = "dt-buttons-container";

        // var buttons = dataTable.buttons();
        // buttons.container().appendTo(buttonsContainer);
        rankingTable.parentNode.insertBefore(buttonsContainer, rankingTable.nextSibling);
    }
});

</script>
@endsection
