<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\AsetRusak;
use Illuminate\Http\Request;

class PengesahanAsetRusakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('tyet');
        $aset_rusak_data = AsetRusak::where('status_pengesahan', 'Diajukan')
            ->orWhere('status_pengesahan', 'Telah Direvisi')->get();
        return view('backend.pengesahan_aset_rusak.index', compact('aset_rusak_data'));
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
        // Get all the checkbox IDs from the request
        $checkboxIds = $request->aset_rusak_check;

        // Loop through all the checked aset_rusak
        foreach ($checkboxIds as $checkboxId) {
            // Find the AsetRusak instance by ID

            $aset_rusak_data = AsetRusak::find($checkboxId);
            $aset_data = Aset::find($aset_rusak_data->aset_id);
            if ($aset_rusak_data) {
                // Find the associated Aset instance
                // Update the status_pengesahan for the AsetRusak instance
                $aset_rusak_data->status_pengesahan = $request->check_value;
                $aset_rusak_data->save(); // Save the changes
            }
            if ($request->check_value == 'Disetujui') {
                $aset_data->jumlah_aset = $aset_data->jumlah_aset - $aset_rusak_data->jumlah_aset_rusak;
                $aset_data->save();
            }
        }


        return redirect()->back()->with('success', 'Proses pengesahan berhasil dilakukan');
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
