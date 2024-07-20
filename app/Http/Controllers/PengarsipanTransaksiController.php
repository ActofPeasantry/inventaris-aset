<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengesahanTransaksi;
use App\Models\Aset;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PengarsipanTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::pluck('nama_supplier', 'id');
        $aset = Aset::pluck('nama_aset', 'id');
        $transaksi_data = Transaksi::where('status_transaksi', 'Selesai')->whereNull('invoice_transaksi')->WhereHas('pengesahanTransaksi', function (Builder $query) {
            $query->where('status_pengesahan', 'Disetujui')->whereNotNull('surat_pengesahan');
        })->get();
        // dd($supplier);
        return view('backend.pengarsipan_aset.index', compact('transaksi_data', 'supplier', 'aset'));
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
        if ($request->hasFile('invoice_transaksi')) {
            $path = $request->file('invoice_transaksi')->store('invoices', 'public');
            foreach ($request->checked_transaksi_id as $transaksi_id) {
                $getTransaksi = Transaksi::find($transaksi_id);
                $getTransaksi->invoice_transaksi = '../../storage/' . $path;
                $getTransaksi->tgl_transaksi = $request->tgl_transaksi;
                $getTransaksi->status_transaksi = 'Selesai';
                $getTransaksi->save();
            }
        }

        return redirect()->back()->with('success', 'Proses pengesahan berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
