<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Http\Controllers\NormalizationController;

class RankingController extends Controller
{
    public function index()
    {
        try {
            // Memanggil fungsi untuk mendapatkan hasil normalisasi dan optimasi dari NormalizationController
            $normalizationController = new NormalizationController();
            $normalizedScores = $normalizationController->normalisasiMoora($normalizationController->getSkor(), $normalizationController->getKriteria());
            $optimizationResults = $normalizationController->optimizedMoora($normalizedScores, $normalizationController->getKriteria());

            // Memanggil fungsi untuk membuat peringkat berdasarkan totalOptimization
            $rankings = $this->createRankings($optimizationResults);

            return view('ranking.index', compact('rankings'))->with('i', 0);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function createRankings($optimizationResults)
{
    try {
        // Inisialisasi array untuk menyimpan peringkat
        $rankings = [];

        // Mendapatkan totalOptimization untuk setiap alternatif
        $totalOptimizations = array_column($optimizationResults, 'totalOptimization');

        // Mengurutkan totalOptimization secara descending
        arsort($totalOptimizations);

        // Menyusun peringkat berdasarkan urutan setelah diurutkan
        $rank = 1;
        foreach ($totalOptimizations as $alternatifId => $totalOptimization) {
            // Make a copy of the array element to avoid "Only variables should be passed by reference" error
            $optimizationData = $optimizationResults[$alternatifId];

            $rankings[$alternatifId] = [
                'rank' => $rank,
                'totalOptimization' => $totalOptimization,
            ];
            $rank++;
        }

        return $rankings;
    } catch (\Exception $e) {
        // Handle exception if needed
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    public function __invoke()
    {
        return $this->index();
    }
}
