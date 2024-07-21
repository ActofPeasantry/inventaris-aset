<?php

namespace App\Http\Controllers;

use App\Models\AsetRusak;
use App\Models\KategoriAset;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        $kategori_data = KategoriAset::all();
        $supplier_data = Supplier::all();
        $aset_rusak_data = AsetRusak::all();
        $in_progress_transaksi_data = Transaksi::where('status_transaksi', 'Sedang Proses')->get();
        $in_progress_aset_rusak_data = AsetRusak::where('status_pengesahan', 'Diajukan')->orWhere('status_pengesahan', 'Telah Direvisi')->get();

        return view(
            'home',
            compact(
                'kategori_data',
                'supplier_data',
                'aset_rusak_data',
                'in_progress_transaksi_data',
                'in_progress_aset_rusak_data',
                'widget'
            )
        );
    }
}
