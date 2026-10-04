<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PaketLaundry;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();

        $totalPaket = PaketLaundry::count();

        $totalTransaksi = Transaksi::count();

        $pendapatanHariIni = Transaksi::whereDate(
            'tgl_masuk',
            now()->toDateString()
        )->sum('total');

        $pendapatanBulanIni = Transaksi::whereYear(
            'tgl_masuk',
            now()->year
        )
            ->whereMonth('tgl_masuk', now()->month)
            ->sum('total');

        $pendapatanHarian = Transaksi::select(
            DB::raw('DATE(tgl_masuk) as tanggal'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('tgl_masuk', now()->year)
            ->groupBy(DB::raw('DATE(tgl_masuk)'))
            ->orderBy('tanggal')
            ->get();

        $pendapatanBulanan = Transaksi::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('tgl_masuk', now()->year)
            ->groupBy(DB::raw('MONTH(tgl_masuk)'))
            ->orderBy('bulan')
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'totalPaket',
            'totalTransaksi',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanHarian',
            'pendapatanBulanan'
        ));
    }
}