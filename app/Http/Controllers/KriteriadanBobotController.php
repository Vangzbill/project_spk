<?php

namespace App\Http\Controllers;

use App\Models\KriteriadanBobotModel;
use Illuminate\Http\Request;

class KriteriadanBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = KriteriadanBobotModel::get();
        $id = KriteriadanBobotModel::pluck('id');
        // Contoh perubahan di metode index()
        return view('kriteria.index', compact('kriteria'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
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
            'nama' => 'required',
            'tipe' => 'required',
            'bobot' => 'required',
        ]);

        KriteriadanBobotModel::create($request->all());

        return redirect()->route('kriteria.index')
                        ->with('success','Criteria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KriteriadanBobotModel  $kriteriabobot
     * @return \Illuminate\Http\Response
     */
    public function show(KriteriadanBobotModel $kriteria)
    {
        // return view('kriteriabobot.show',compact('kriteriabobot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KriteriadanBobotModel  $kriteriabobot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kriteria = KriteriadanBobotModel::find($id);
        return view('kriteria.edit',compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KriteriadanBobotModel  $kriteriabobot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kriteria = KriteriadanBobotModel::findOrFail($id);

        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'bobot' => 'required',
        ]);

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Criteria updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KriteriadanBobotModel  $kriteriabobot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = KriteriadanBobotModel::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Criteria deleted successfully');
    }

}
