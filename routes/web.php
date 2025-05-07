<?php

use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PresentaseController;
use App\Http\Controllers\SortirController;
use App\Http\Controllers\TrukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RiwayatSortirController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resource('users', UserController::class);
    Route::resource('truks', TrukController::class);
    Route::resource('supirs', SupirController::class);
    Route::resource('presentases', PresentaseController::class);
    Route::resource('sortirs', SortirController::class);
    Route::resource('penjuals', PenjualController::class);

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/transaksis/create', [TransaksiController::class, 'create'])->name('transaksis.create');
    Route::post('/transaksis', [TransaksiController::class, 'store'])->name('transaksis.store');
    Route::get('/transaksis/report', [TransaksiController::class, 'report'])->name('transaksis.report');
    Route::get('/transaksis/{id}/invoice', [TransaksiController::class, 'invoice'])->name('transaksis.invoice');
    Route::get('/transaksis/{id}', [TransaksiController::class, 'show'])->name('transaksis.show');
    Route::get('/riwayat-sortirs', [RiwayatSortirController::class, 'index'])->name('riwayat_sortirs.index');
});
