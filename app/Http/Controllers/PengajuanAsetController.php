<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\PengesahanTransaksi;
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

        // Your input array
        $input = $request->all();
        // Initialize the array to hold the details
        $transDetails = [];
        // Loop through the input array
        foreach ($input as $key => $value) {
            if (preg_match('/^aset_id-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['aset_id'] = $value;
            }
            if (preg_match('/^jumlah-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['jumlah'] = $value;
            }
            if (preg_match('/^harga-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['harga'] = $value;
            }
        }
        // Reindex array to start from 0
        $transDetails = array_values($transDetails);

        $user_id = Auth::user()->id;
        $transaksi = Transaksi::create([
            'user_id' => $user_id,
            'supplier_id' => $request->supplier_id,
        ]);

        foreach ($transDetails as $detail) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'aset_id' => $detail['aset_id'],
                'jumlah' => $detail['jumlah'],
                'biaya' => $detail['harga'],
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
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
        // Fetch the transaksi details and eager load the associated aset data
        $transaksi_data = Transaksi::where('id', $id)->get();
        $detail_data = TransaksiDetail::where('transaksi_id', $id)->with('aset')->get();

        $data = [
            'transaksi_data' => $transaksi_data,
            'detail_data' => $detail_data
        ];
        return response()->json($data);
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
        Transaksi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }

    public function uploadInvoice(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->transaksi_id);

        $aset_data = new Aset();
        $transaksi_detail_data = TransaksiDetail::where('transaksi_id', $request->transaksi_id)->get();
        // dd($transaksi_detail_data[0]);

        if ($request->hasFile('invoice')) {
            $path = $request->file('invoice')->store('invoices', 'public');
            $transaksi->invoice_transaksi = '../../storage/' . $path;
            $transaksi->status_transaksi = 'Selesai';
            $transaksi->save();

            foreach ($transaksi_detail_data as $transaksi_detail) {
                $aset_data = Aset::where('id', $transaksi_detail->aset_id)->first();
                $aset_data->jumlah_aset = $aset_data->jumlah_aset + $transaksi_detail->jumlah;
                $aset_data->save();
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    public function updateOrder(Request $request)
    {
        // Your input array
        $input = $request->all();

        // Initialize the array to hold the details
        $transDetails = [];
        // Loop through the input array
        foreach ($input as $key => $value) {
            if (preg_match('/^aset_id-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['aset_id'] = $value;
            }
            if (preg_match('/^jumlah-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['jumlah'] = $value;
            }
            if (preg_match('/^harga-(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $transDetails[$index]['harga'] = $value;
            }
        }
        // Reindex array to start from 0
        $transDetails = array_values($transDetails);

        // Update Transaksi and PengesahanTransaksi
        $transaksi = Transaksi::findOrFail($request->transaksi_id);
        $transaksi->update([
            'tujuan_transaksi' => $request->tujuan_transaksi,
            'supplier_id' => $request->supplier_id
        ]);
        $pengesahan = PengesahanTransaksi::where('transaksi_id', $request->transaksi_id);
        $pengesahan->update([
            'status_pengesahan' => "Telah Direvisi"
        ]);

        // Delete Current Transaksi Details. Im too lazy to check each transaksiDetail and update them :P
        TransaksiDetail::where('transaksi_id', $request->transaksi_id)->delete();
        foreach ($transDetails as $detail) {
            TransaksiDetail::create([
                'transaksi_id' => $request->transaksi_id,
                'aset_id' => $detail['aset_id'],
                'jumlah' => $detail['jumlah'],
                'biaya' => $detail['harga']
            ]);
        }

        // dd([$transDetails, $input]);
        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }
}
