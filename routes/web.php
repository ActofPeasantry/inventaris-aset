<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AsetRusakController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\LaporanTransaksi;
use App\Http\Controllers\PengajuanAsetController;
use App\Http\Controllers\PengarsipanTransaksiController;
use App\Http\Controllers\PengesahanAsetRusakController;
use App\Http\Controllers\PengesahanTransaksiController;
use App\Http\Controllers\ReviewTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserRoleController;
use App\Models\Aset;
use App\Models\PengesahanTransaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::middleware('auth')->group(function () {
    route::resource('laporan_transaksi', LaporanTransaksi::class);
    Route::post('/laporan_transaksi/search', [LaporanTransaksi::class, 'search'])->name('laporan_transaksi.search');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::resources([
        'user_role' => UserRoleController::class,
    ]);
});

Route::middleware(['auth', 'auth.pegawai'])->group(function () {
    Route::resources([
        'pengajuan_aset' => PengajuanAsetController::class,
        'pelaporan_aset_rusak' => AsetRusakController::class,
    ]);
    Route::post('pengajuan_aset/update_order/', [PengajuanAsetController::class, 'updateOrder'])->name('pengajuan_aset.update_order');
    Route::post('pengajuan_aset/upload_invoice/', [PengajuanAsetController::class, 'uploadInvoice'])->name('pengajuan_aset.upload_invoice');
});

Route::middleware(['auth', 'auth.kepalaDinas'])->group(function () {
    Route::resources([
        'pengesahan_transaksi' => PengesahanTransaksiController::class,
        'pengesahan_aset_rusak' => PengesahanAsetRusakController::class,
    ]);
});

Route::middleware(['auth', 'auth.adminOrKepalaDinas'])->group(function () {
    Route::resources([
        'kategori_aset' => KategoriAsetController::class,
        'aset' => AsetController::class,
        'supplier' => SupplierController::class,
        'review_transaksi' => ReviewTransaksiController::class,
        'pengarsipan_transaksi' => PengarsipanTransaksiController::class,
    ]);
    Route::post('pengarsipan_transaksi/deny', [PengarsipanTransaksiController::class, 'deny'])->name('pengarsipan_transaksi.deny');
});



Route::get('/order-aset-form-template', function () {
    $index = request('index');
    $aset = Aset::pluck('nama_aset', 'id');
    return view('backend.pengajuan_aset.order_aset_form', compact('index', 'aset'));
});



Route::get('/about', function () {
    return view('about');
})->name('about');
