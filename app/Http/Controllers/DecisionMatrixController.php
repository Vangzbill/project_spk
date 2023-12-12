<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\AlternatifdanSkorModel;
use App\Models\KriteriadanBobotModel;
use Illuminate\Http\Request;

class DecisionMatrixController extends Controller
{
    public function index()
    {
        $alternatif = AlternatifModel::all();
        $kriteria = KriteriadanBobotModel::all();
        $skor = AlternatifdanSkorModel::with(['alternatif', 'kriteria'])->get();

        return view('decision_matrix.index', compact('alternatif', 'kriteria', 'skor'));
    }

}