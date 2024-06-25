<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_data = KategoriAset::all();
        $aset_data = Aset::all();
        return view('backend.aset.index', compact('aset_data', 'kategori_data'));
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
        $user_id = Auth::user()->id;
        Aset::create([
            'user_id' => $user_id,
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'deskripsi_aset' => $request->deskripsi_aset,
            'kategori_aset_id' => $request->kategori_aset_id
        ]);

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
        $aset = Aset::findOrFail($id);
        return response()->json($aset);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Aset::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Aset::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
