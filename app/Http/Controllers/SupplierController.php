<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier_data = Supplier::all();
        return view('backend.supplier.index', compact('supplier_data'));
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
        Supplier::create($request->all());
        return redirect()->back()->with('success', 'Data Berhasil ditambahkan');
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
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Supplier::findOrFail($id)->update($request->all());
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
