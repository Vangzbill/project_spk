@extends('layouts.template')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Benefit Values</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>Benefit Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($hitungNilaiAkhir['benefit'] as $alternatifId => $benefitValue)
                                    {{-- @if(@isset($alternatif[$alternatifId])) --}}
                                        <tr>
                                            <td>{{ $alternatif->where('id', $alternatifId)->first->kode['kode'] }}</td>
                                            <td>{{ $benefitValue }}</td>
                                        </tr>
                                    {{-- @endisset --}}

                                @endforeach
                            </tbody>
                        </table>
                    
                        <!-- Display Cost Values -->
                        <h2>Cost Values</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>Cost Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hitungNilaiAkhir['cost'] as $alternatifId => $costValue)
                                    {{-- @if (isset($alternatif[$alternatifId])) --}}
                                        <tr>
                                            <td>{{ $alternatif->where('id', $alternatifId)->first->kode['kode'] }}</td>
                                            <td>{{ $costValue }}</td>
                                        </tr>
                                    {{-- @endif --}}
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