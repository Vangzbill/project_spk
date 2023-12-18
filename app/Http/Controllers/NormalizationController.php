<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\AlternatifdanSkorModel;
use App\Models\KriteriadanBobotModel;
use Illuminate\Support\Facades\DB;

class NormalizationController extends Controller
{
    private $skor;
    private $kriteria;

    public function __construct()
    {
        // Retrieve data or initialize as needed
        $this->skor = AlternatifdanSkorModel::select(
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

        $this->kriteria = KriteriadanBobotModel::get();
    }

    public function index()
    {
        try {
            // Mengambil semua skor alternatif beserta informasi terkait
            $skor = $this->skor;

            // Mengambil semua kriteria bobot
            $kriteria = $this->kriteria;

            // Mendapatkan data alternatif
            $alternatif = AlternatifModel::all();  // Ganti ini sesuai dengan model dan query yang sesuai di aplikasi Anda

            // Memanggil fungsi untuk normalisasi Moora
            $normalizedScores = $this->normalisasiMoora($skor, $kriteria);

            $optimizationResults = $this->optimizedMoora($normalizedScores, $kriteria);

            return view('normalization.index', compact('skor', 'kriteria', 'alternatif', 'normalizedScores', 'optimizationResults'))->with('i', 0);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Fungsi untuk normalisasi Moora
    public function normalisasiMoora(&$skor, $kriteria)
    {
        // Array untuk menyimpan total kuadrat setiap kriteria
        $totalKuadrat = [];

        // Perhitungan total kuadrat untuk setiap kriteria
        foreach ($kriteria as $kriteria) {
            $totalKuadrat[$kriteria->id] = AlternatifdanSkorModel::where('kriteria_id', $kriteria->id)
                ->sum(DB::raw('POWER(skor, 2)'));
        }

        // Array untuk menyimpan akar kuadrat dari total kuadrat
        $akarKuadrat = [];

        // Perhitungan akar kuadrat dari total kuadrat
        foreach ($totalKuadrat as $kriteriaId => $total) {
            $akarKuadrat[$kriteriaId] = sqrt($total);
        }

        // Array untuk menyimpan hasil normalisasi
        $normalizedScores = [];

        // Normalisasi Moora
        foreach ($skor as $skor) {
            $normalizedScore = round(($akarKuadrat[$skor->kriteria_id] != 0) ? $skor->skor / $akarKuadrat[$skor->kriteria_id] : 0, 2);

            // Menyimpan hasil normalisasi ke dalam array
            $normalizedScores[$skor->alternatif_id][$skor->kriteria_id] = $normalizedScore;
        }
        // Return the array of normalized scores if needed
        return $normalizedScores;
    }

    public function optimizedMoora($normalizedScores, $kriteria)
    {
        try {
            $optimizationResults = [];
    
            // Iterate through each alternatif
            foreach ($normalizedScores as $alternatifId => $normalizedScoresPerAlternatif) {
                // Initialize the total optimization for the current alternatif
                $totalOptimization = 0;
    
                // Iterate through each kriteria
                foreach ($normalizedScoresPerAlternatif as $kriteriaId => $normalizedScore) {
                    // Find the corresponding weight (bobot) for the current kriteria
                    $kriteriaData = $kriteria->where('id', $kriteriaId)->first();
                    $bobot = ($kriteriaData->tipe == 'cost') ? $kriteriaData->bobot * 0.10 * -1 : $kriteriaData->bobot * 0.10;
    
                    // Ensure the kriteria ID is valid
                    if ($bobot !== null) {
                        // Calculate the optimization value for the current kriteria
                        $optimizationValue = $normalizedScore * $bobot;
    
                        // Accumulate the optimization values for each kriteria
                        $totalOptimization += $optimizationValue;
    
                        // Optionally, you can store the formatted optimization values in an array
                        $optimizationResults[$alternatifId][$kriteriaId] = number_format($optimizationValue, 2);
                    }
                }
    
                // Store the total optimization value for the current alternatif
                $optimizationResults[$alternatifId]['totalOptimization'] = number_format($totalOptimization, 2);
            }
    
            return $optimizationResults;
        } catch (\Exception $e) {
            // Handle exception if needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function hitungNilaiAkhir($optimizationResults, $alternatif, $kriteria)
{
    $hitungNilaiAkhir = [
        'benefit' => [],
        'cost' => [],
    ];

    // Iterasi melalui setiap alternatif
    foreach ($optimizationResults as $alternatifId => $optimizationData) {
        // Pastikan bahwa ID alternatif ada dalam array $alternatif
        if ($alternatif->contains('id', $alternatifId)) {
            $finalValueB = 0;
            $finalValueC = 0;

            foreach ($optimizationData as $kriteriaId => $optimizationValue) {
                if ($kriteriaId !== 'totalOptimization') {
                    // Tentukan jenis kriteria (benefit atau cost)
                    $tipeKriteria = $kriteria->where('id', $kriteriaId)->first()->tipe;

                    // Untuk kriteria benefit, tambahkan nilai optimisasi langsung
                    // Untuk kriteria cost, kurangkan nilai optimisasi langsung
                    if ($tipeKriteria == 'benefit') {
                        $finalValueB += $optimizationValue;
                    } elseif ($tipeKriteria == 'cost') {
                        $finalValueC += $optimizationValue;
                    }
                }
            }

            // Simpan nilai akhir untuk alternatif saat ini
            $hitungNilaiAkhir['benefit'][$alternatifId] = number_format($finalValueB, 2);
            $hitungNilaiAkhir['cost'][$alternatifId] = number_format($finalValueC, 2);
        }
    }

    return $hitungNilaiAkhir;
}
public function hitungYi($hitungNilaiAkhir)
{
    $hitungYi = [];

    // Iterasi melalui setiap alternatif
    foreach ($hitungNilaiAkhir['benefit'] as $alternatifId => $benefitValue) {
        // Pastikan bahwa ID alternatif ada dalam array cost
        if (isset($hitungNilaiAkhir['cost'][$alternatifId])) {
            // Hitung nilai Yi (benefit - cost)
            $yiValue = $benefitValue + $hitungNilaiAkhir['cost'][$alternatifId];

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
public function showRanking()
{
    try {
        // Retrieve necessary data and calculations
        // For example, you may need to recalculate Yi values and rankings
        $scores = AlternatifdanSkorModel::select(
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

        $normalizedScores = $this->normalisasiMoora($scores, $kriteria);
        $optimizationResults = $this->optimizedMoora($normalizedScores, $kriteria);
        $hitungNilaiAkhir = $this->hitungNilaiAkhir($optimizationResults, $alternatif, $kriteria);
        $hitungYi = $this->hitungYi($hitungNilaiAkhir);

        // Pass the necessary data to the ranking view
        return view('ranking.index', compact('scores', 'kriteria', 'alternatif', 'normalizedScores', 'optimizationResults', 'hitungNilaiAkhir','hitungYi'));
    } catch (\Exception $e) {
        // Handle exception if needed
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function getSkor()
    {
        try {
            return $this->skor->toArray();
        } catch (\Exception $e) {
            // Handle exception if needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getKriteria()
    {
        try {
            return $this->kriteria->toArray();
        } catch (\Exception $e) {
            // Handle exception if needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
