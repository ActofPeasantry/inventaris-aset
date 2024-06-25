<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriAsetController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::resources([
    'aset' => AsetController::class,
    'supplier' => SupplierController::class,
    'kategori_aset' => KategoriAsetController::class,
]);


Route::get('/about', function () {
    return view('about');
})->name('about');
