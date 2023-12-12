<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\KriteriadanBobotController;
use App\Http\Controllers\NormalizationController;
use App\Http\Controllers\RankingController; // Add this line
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [DashboardController::class, 'index'])->name('dashboard.index');

Route::resources([
    'alternatif' => AlternatifController::class,
    'kriteria'=> KriteriadanBobotController::class,
    'decision_matrix'=> DecisionMatrixController::class,
]);

Route::get("normalization", [NormalizationController::class,"index"])->name("normalization.index");

Route::get('ranking', [RankingController::class, 'index'])->name('ranking.index');

Route::put('kriteria/{id}', [KriteriadanBobotController::class, 'update'])->name('kriteria.update');
