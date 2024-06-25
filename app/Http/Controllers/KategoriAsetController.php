<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_data = KategoriAset::all();
        return view('backend.kategori_aset.index', compact('kategori_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        KategoriAset::create($request->all());
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
        $kriteria = KategoriAset::findOrFail($id);
        return response()->json($kriteria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        KategoriAset::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KategoriAset::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
