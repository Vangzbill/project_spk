<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode' => 'A1', 'nama' => 'Adi Sitorus, S.Pd'],
            ['kode' => 'A2', 'nama' => 'Lestari Hutagalung, S.Pd'],
            ['kode' => 'A3', 'nama' => 'Dame Sirait, S.Pd'],
            ['kode' => 'A4', 'nama' => 'Dedi Sitanggang, S.Pd'],
            ['kode' => 'A5', 'nama' => 'Putra Wijaya, S.Pd'],
            ['kode' => 'A6', 'nama' => 'Dian Sari, S.Pd'],
            ['kode' => 'A7', 'nama' => 'Aditya Pratama, S.Pd'],
            ['kode' => 'A8', 'nama' => 'Siska Anggraini, S.Pd'],
            ['kode' => 'A9', 'nama' => 'Bayu Kusuma, S.Pd'],
            ['kode' => 'A10', 'nama' => 'Maya Indah, S.Pd'],
            ['kode' => 'A11', 'nama' => 'Rizki Maulana, S.Pd'],
            ['kode' => 'A12', 'nama' => 'Anita Dewi, S.Pd'],
            ['kode' => 'A13', 'nama' => 'Arianto Saputra, S.Pd'],
            ['kode' => 'A14', 'nama' => 'Mega Putri, S.Pd'],
            ['kode' => 'A15', 'nama' => 'Dharma Wijaya, S.Pd'],
            ['kode' => 'A16', 'nama' => 'Nanda Pratama, S.Pd'],
            ['kode' => 'A17', 'nama' => 'Fita Lestari, S.Pd'],
            ['kode' => 'A18', 'nama' => 'Adi Nugroho, S.Pd'],
            ['kode' => 'A19', 'nama' => 'Yuli Astuti, S.Pd'],
            ['kode' => 'A20', 'nama' => 'Bambang Santoso, S.Pd'],
        ];

        // Insert data into the table
        DB::table('alternatif')->insert($data);
    }
}
