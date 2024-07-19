<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class LaporanTransaksi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all transaksi data that has invoice attached
        $transaksi_model = new Transaksi();
        $transaksi_data = $transaksi_model->transReport();

        // get Years based on transaksi updated_at datetime
        if ($transaksi_model->get()->isNotEmpty()) {
            $years = $transaksi_model->getYears();
            $default_year = $years[0];
            // dd($years);
        } else {
            $years = now();
            $default_year = now();
        }

        $default_month = 0;

        return view('backend.laporan_transaksi.index', compact('transaksi_data', 'years', 'default_year', 'default_month'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the transaksi details and eager load the associated aset data
        $detail_data = TransaksiDetail::where('transaksi_id', $id)->with('aset')->get();

        // Transform the data to include asset names directly in the response
        $data = $detail_data->map(function ($detail) {
            return [
                'id' => $detail->id,
                'jumlah' => $detail->jumlah,
                'biaya' => $detail->biaya,
                'nama_aset' => $detail->aset->nama_aset,
            ];
        });

        return response()->json($data);
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
