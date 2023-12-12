<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifModel;
use App\Models\AlternatifdanSkorModel;
use App\Models\KriteriadanBobotModel;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function hitungYi($hitungNilaiAkhir)
    {
        $hitungYi = [];

        // Iterasi melalui setiap alternatif
        foreach ($hitungNilaiAkhir['benefit'] as $alternatifId => $benefitValue) {
            // Pastikan bahwa ID alternatif ada dalam array cost
            if (isset($hitungNilaiAkhir['cost'][$alternatifId])) {
                // Hitung nilai Yi (benefit - cost)
                $yiValue = $benefitValue - $hitungNilaiAkhir['cost'][$alternatifId];

                // Simpan nilai Yi untuk alternatif saat ini
                $hitungYi[$alternatifId]['yiValue'] = number_format($yiValue, 2);
            }
        }

        // Urutkan alternatif berdasarkan nilai Yi secara descending
        arsort($hitungYi);

        // Berikan ranking pada setiap alternatif
        $ranking = 1;
        foreach ($hitungYi as &$alternatif) {
            $alternatif['ranking'] = $ranking;
            $ranking++;
        }

        return $hitungYi;
    }

    public function index()
    {
        try {
            // Retrieve necessary data and calculations
            // For example, you may need to recalculate Yi values and rankings
            $skor = AlternatifdanSkorModel::select(
                'alternatif_dan_skor.id as id',
                'alternatif.id as alternatif_id',
                'kriteria_dan_bobot.id as kriteria_id',
                'alternatif_dan_skor.skor as skor',
                'alternatif.kode as alternatif_kode',
                'alternatif.nama as alternatif_nama',
                'kriteria_dan_bobot.kode as kriteria_kode',
                'kriteria_dan_bobot.nama as kriteria_nama',
                'kriteria_dan_bobot.tipe as tipe',
                'kriteria_dan_bobot.bobot as bobot',
            )
                ->leftJoin('alternatif', 'alternatif.id', '=', 'alternatif_dan_skor.alternatif_id')
                ->leftJoin('kriteria_dan_bobot', 'kriteria_dan_bobot.id', '=', 'alternatif_dan_skor.kriteria_id')
                ->get();

            $kriteria = KriteriadanBobotModel::get();
            $alternatif = AlternatifModel::get();

            $normalizationController = new NormalizationController();
            $normalizedScores = $normalizationController->normalisasiMoora($skor, $kriteria);
            $normTerbobotResults = $normalizationController->normTerbobotMoora($normalizedScores, $kriteria);
            $hitungNilaiAkhir = $normalizationController->hitungNilaiAkhir($normTerbobotResults, $alternatif, $kriteria);

            // Panggil fungsi hitungYi dan simpan hasilnya
            $hitungYi = $this->hitungYi($hitungNilaiAkhir);

            // Pass the necessary data to the ranking view
            return view('ranking.index', compact('skor', 'kriteria', 'alternatif', 'normalizedScores', 'normTerbobotResults', 'hitungNilaiAkhir', 'hitungYi'));
        } catch (\Exception $e) {
            // Handle exception if needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
