<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriadanBobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'kode' => 'C1',
                'nama' => 'Common Sense',
                'tipe' => 'Benefit',
                'bobot' => 10,
            ],
            [
                'kode' => 'C2',
                'nama' => 'Verbalisasi kodee',
                'tipe' => 'Benefit',
                'bobot' => 5,
            ],
            [
                'kode' => 'C3',
                'nama' => 'Sistematika Berpikir',
                'tipe' => 'Benefit',
                'bobot' => 10,
            ],
            [
                'kode' => 'C4',
                'nama' => 'Penalaran Dan Solusi Real',
                'tipe' => 'Benefit',
                'bobot' => 20,
            ],
            [
                'kode' => 'C5',
                'nama' => 'Konsentrasi',
                'tipe' => 'Benefit',
                'bobot' => 10,
            ],
            [
                'kode' => 'C6',
                'nama' => 'Logika Praktis',
                'tipe' => 'Benefit',
                'bobot' => 15,
            ],
            [
                'kode' => 'C7',
                'nama' => 'Fleksibilitas Berpikir',
                'tipe' => 'Benefit',
                'bobot' => 10,
            ],
            [
                'kode' => 'C8',
                'nama' => 'Imajinasi Kreatif',
                'tipe' => 'Benefit',
                'bobot' => 5,
            ],
            [
                'kode' => 'C9',
                'nama' => 'Antisipasi',
                'tipe' => 'Benefit',
                'bobot' => 10,
            ],
            [
                'kode' => 'C10',
                'nama' => 'Gaji dan Tunjangan',
                'tipe' => 'Cost',
                'bobot' => 5,
            ],
        ];

        // Insert data into the table
        DB::table('kriteria_dan_bobot')->insert($data);
    }
}
