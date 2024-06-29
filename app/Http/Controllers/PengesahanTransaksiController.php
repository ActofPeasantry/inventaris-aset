<?php

namespace App\Http\Controllers;

use App\Models\PengesahanTransaksi;
use App\Models\Aset;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengesahanTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::pluck('nama_supplier', 'id');
        $aset = Aset::pluck('nama_aset', 'id');
        $transaksi_data =  Transaksi::doesntHave('pengesahanTransaksi')->get();
        // dd($supplier);
        return view('backend.pengesahan_aset.index', compact('transaksi_data', 'supplier', 'aset'));
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

        // Loop all the checked transaksis
        foreach ($request->transaksi_check as $value) {
            // Check if the transaksi is already in the database
            $exist = PengesahanTransaksi::where('transaksi_id', $value)->exists();
            if (!$exist) {
                // If the transaksi is not in the database, create a new record
                PengesahanTransaksi::create([
                    'user_id' => Auth::user()->id,
                    'transaksi_id' => $value,
                    'status_pengesahan' => $request->check_value
                ]);

                // Update the status of the transaksi to "Ditolak" if $request->check_value is "Ditolak"
                if ($request->check_value == 'Ditolak') {
                    Transaksi::find($value)->update([
                        'status_transaksi' => 'Batal',
                    ]);
                }
            } else {
                // If the transaksi is already in the database, update the status
                PengesahanTransaksi::where('transaksi_id', $value)->update([
                    'user_id' => Auth::user()->id,
                    'status_pengesahan' => $request->check_value
                ]);
            }
        }
        return redirect()->back()->with('success', 'Proses pengesahan berhasil dilakukan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
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
    public function edit(PengesahanTransaksi $pengesahanTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengesahanTransaksi $pengesahanTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengesahanTransaksi $pengesahanTransaksi)
    {
        //
    }
}
