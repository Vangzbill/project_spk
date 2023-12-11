@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h2 class="card-title">Selamat Datang di Sistem Pendukung Keputusan</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <h4><i class="icon fa fa-info"></i> Informasi</h4>
                                <p>Sistem Pendukung Keputusan ini dibuat untuk memenuhi tugas mata kuliah Sistem Pendukung Keputusan.</p>
                                <p>Anggota Kelompok :</p>
                                <ul>
                                    <li>Afif Lukmanul H</li>
                                    <li>Sabilla Luthfi Rahmadhan</li>
                                    <li>Taufiqy Firdaus J</li>
                                </ul>
                            </div>
                            Sistem ini dapat membantu seseorang untuk mengambil keputusan dengan menggunakan Metode MOORA.
                            <br> Cara Penggunaan:
                            <ol>
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
@endsection