<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Halaman Login & Redirect Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Menampilkan Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Memproses Form Login (diganti ke POST)
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Logout (Mendukung GET & POST agar tidak error saat diklik)
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Fitur Aplikasi (Tanpa Penghambat Middleware)
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Pelanggan
Route::resource('pelanggan', PelangganController::class)
    ->except(['show']);

// Paket Laundry
Route::resource('paket', PaketLaundryController::class)
    ->except(['show']);

// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])
    ->name('transaksi.index');

Route::get('/transaksi/create', [TransaksiController::class, 'create'])
    ->name('transaksi.create');

Route::post('/transaksi', [TransaksiController::class, 'store'])
    ->name('transaksi.store');

// Edit seluruh data transaksi
Route::get('/transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])
    ->name('transaksi.edit');

// Simpan seluruh perubahan transaksi
Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])
    ->name('transaksi.update');

Route::get('/transaksi/{transaksi}', [TransaksiController::class, 'show'])
    ->name('transaksi.show');

Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])
    ->name('transaksi.destroy');

// Laporan
Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');