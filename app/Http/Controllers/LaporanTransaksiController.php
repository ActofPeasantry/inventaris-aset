<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
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
            $selected_year = $years[0];
            // dd($years);
        } else {
            $years = now();
            $selected_year = now();
        }

        $selected_month = 0;
        $selected_purpose = 0;
        $selected_trans_purpose = 0;

        return view(
            'backend.laporan_transaksi.index',
            compact('transaksi_data', 'years', 'selected_year', 'selected_month', 'selected_trans_purpose')
        );
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

    public function search(Request $request)
    {
        // dd($request->get('year'));
        $transaksi_model = new Transaksi();
        if ($transaksi_model->get()->isEmpty()) {
            return redirect()->route('laporan_transaksi.index');
        }

        $years = $transaksi_model->getYears();
        $selected_trans_purpose = $request->get('tujuan_transaksi');
        $selected_year = $request->get('year');
        $selected_month = $request->get('month');
        $transaksi_data = $transaksi_model->searchTransReport($selected_trans_purpose, $selected_month, $selected_year);

        // dd([$selected_trans_purpose, $selected_month, $selected_year,]);
        // dd($transaksi_data);
        return view(
            'backend.laporan_transaksi.index',
            compact('transaksi_data', 'years', 'selected_year', 'selected_month', 'selected_trans_purpose')
        );
    }
}
