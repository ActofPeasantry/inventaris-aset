<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanAsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id =  Auth::user()->id;
        $supplier = Supplier::pluck('nama_supplier', 'id');
        $aset = Aset::pluck('nama_aset', 'id');
        $transaksi_data =  Transaksi::where([
            'user_id' => $user_id,
            'status_transaksi' => 'sedang proses',
        ])->get();
        // dd(is_null($transaksi_data[1]->pengesahanTransaksi));
        return view('backend.pengajuan_aset.index', compact('transaksi_data', 'supplier', 'aset'));
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
        // dd($request->input('aset'));

        $user_id = Auth::user()->id;
        $transaksi = Transaksi::create([
            'user_id' => $user_id,
            'supplier_id' => $request->supplier_id,
        ]);
        $asets = $request->input('aset');
        foreach ($asets as $aset) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'aset_id' => $aset['aset_id'],
                'jumlah' => $aset['jumlah'],
                'biaya' => $aset['harga']
            ]);
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
