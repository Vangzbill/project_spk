@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
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
                                            <h2 class="card-title" style="color: white">Selamat Datang di Sistem Pendukung Keputusan</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-info">
                                            <h4><i class="fa fa-info"></i> Informasi</h4>
                                            <p>Sistem Pendukung Keputusan ini dibuat untuk memenuhi tugas mata kuliah Sistem Pendukung Keputusan.</p>
                                            <p>Anggota Kelompok :</p>
                                            <ul>
                                                <li>1. Afif Lukmanul H          (2141720262)</li>
                                                <li>2. Sabilla Luthfi Rahmadhan (2141720122)</li>
                                                <li>3. Taufiqy Firdaus J        (2141720124)</li>
                                            </ul>
                                        </div>
                                        <h5 style="color: white">Sistem ini dapat membantu proses pengambilan keputusan dengan menggunakan Metode MOORA.</h6>
                                        <br> <p style="color: white">Cara Penggunaan:</p>
                                        <ol style="color: white">
                                            <li>Masuk ke menu "Kriteria & Bobot" untuk menambahkan kriteria beserta bobotnya.</li>
                                            <li>Gunakan menu "Alternatif & Skor" untuk menambahkan alternatif dan nilai skornya.</li>
                                            <li>Cek menu "Ranking" untuk melihat hasilnya.</li>
                                        </ol>
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