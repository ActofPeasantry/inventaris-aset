<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\AsetRusak;
use Illuminate\Http\Request;

class AsetRusakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aset_data = Aset::where('jumlah_aset', '>', '0')->get();
        $aset_rusak_data = AsetRusak::all();
        return view('backend.pelaporan_aset_rusak.index', compact('aset_rusak_data', 'aset_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $aset_rusak = AsetRusak::create($request->all());

        $aset_data = Aset::where('id', $aset_rusak->aset_id)->first();
        $aset_data->jumlah_aset = $aset_data->jumlah_aset - $aset_rusak->jumlah_aset_rusak;
        $aset_data->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = AsetRusak::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $aset_rusak = AsetRusak::findorFail($id);
        $aset_rusak->jumlah_aset_rusak = $request->input('jumlah_aset_rusak');
        $aset_rusak->save();

        $subtracted_jumlah_aset = $request->input('jumlah_aset_rusak') - $request->input('old_jumlah_aset_rusak');
        $aset_data = Aset::where('id', $aset_rusak->aset_id)->first();
        $aset_data->jumlah_aset = $aset_data->jumlah_aset - $subtracted_jumlah_aset;
        $aset_data->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aset_rusak = AsetRusak::findorFail($id);
        $aset_data = Aset::where('id', $aset_rusak->aset_id)->first();

        $aset_data->jumlah_aset = $aset_data->jumlah_aset + $aset_rusak->jumlah_aset_rusak;
        $aset_data->save();

        $aset_rusak->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
