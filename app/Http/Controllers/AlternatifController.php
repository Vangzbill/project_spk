<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\AlternatifdanSkorModel;
use App\Models\KriteriadanBobotModel;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skor = AlternatifdanSkorModel::select(
            'alternatif_dan_skor.id as id',
            'alternatif.id as alternatif_id',
            'kriteria_dan_bobot.id as kriteria_id',
            'alternatif_dan_skor.skor as skor',
            'alternatif.kode as alternatif_kode',
            'alternatif.nama as alternatif_nama',
            'kriteria_dan_bobot.kode as kode',
            'kriteria_dan_bobot.nama as nama',
            'kriteria_dan_bobot.tipe as tipe',
            'kriteria_dan_bobot.bobot as bobot',
        )
        ->leftJoin('alternatif', 'alternatif.id', '=', 'alternatif_dan_skor.alternatif_id')
        ->leftJoin('kriteria_dan_bobot', 'kriteria_dan_bobot.id', '=', 'alternatif_dan_skor.kriteria_id')
        ->get();

        $alternatif = AlternatifModel::get();

        $kriteria = KriteriadanBobotModel::get();
        return view('alternatif.index', compact('skor','alternatif', 'kriteria'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $kriteria = KriteriadanBobotModel::get();
        return view('alternatif.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'kode'=> 'required',
        'nama' => 'required'
    ]);

    // Menyimpan alternatif
    $alt = new AlternatifModel;
    $alt->kode = $request->kode;
    $alt->nama = $request->nama;
    $alt->save();

    // Menyimpan skor
    $kriteria = KriteriadanBobotModel::get();
    foreach ($kriteria as $k) {
        $skor = new AlternatifdanSkorModel();
        $skor->alternatif_id = $alt->id;
        $skor->kriteria_id = $k->id;
        $skor->skor = 0; // Set a default value, change as needed
        $skor->save();
    }

    return redirect()->route('alternatif.index')
                    ->with('success', 'Alternatif created successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show( $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(AlternatifModel $alternatif)
    {
        $kriteria = KriteriadanBobotModel::get();
        $alternatifskor = AlternatifdanSkorModel::where('alternatif_id', $alternatif->id)->get();
        return view('alternatif.edit', compact('alternatif', 'alternatifskor', 'kriteria'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    // Metode update
    public function update(Request $request, AlternatifModel $alternatif)
    {
        // Validasi
        $request->validate([
            'kode.*'=> 'required',
            'nama.*' => 'required',
            'skor' => 'required|array',
            'skor.*' => 'required|numeric',
        ]);
    
        // Menyimpan Skor
        $kriteria = KriteriadanBobotModel::get();
    
        foreach ($kriteria as $k) {
            $skor = AlternatifdanSkorModel::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $k->id,
                ],
                [
                    'skor' => $request->skor[$k->id] ?? 0,
                ]
            );
        }
    
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui');
    }
    







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlternatifModel $alternatif)
    {
        $skor = AlternatifdanSkorModel::where('alternatif_id', $alternatif->id)->delete();
        $alternatif->delete();

        return redirect()->route('alternatif.index')
                        ->with('success','alternatif deleted successfully');
    }
}
