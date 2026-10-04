<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketLaundryController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [
    LoginController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.process');

Route::middleware('admin.auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::resource(
        'pelanggan',
        PelangganController::class
    )->except([
        'show'
    ]);

    Route::resource(
        'paket',
        PaketLaundryController::class
    )->except([
        'show'
    ]);

    Route::resource(
        'transaksi',
        TransaksiController::class
    )->only([
        'index',
        'create',
        'store',
        'show',
        'destroy'
    ]);

    Route::get('/laporan', [
        LaporanController::class,
        'index'
    ])->name('laporan');

    Route::post('/logout', [
        LoginController::class,
        'logout'
    ])->name('logout');
});