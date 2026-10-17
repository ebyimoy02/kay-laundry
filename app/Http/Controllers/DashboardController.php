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
        // Periksa session login
        if (!session()->has('logged_in')) {
            return redirect()->route('login');
        }

        // Total data
        $totalPelanggan = DB::table('pelanggan')->count();
        $totalPaket = PaketLaundry::count();
        $totalTransaksi = Transaksi::count();

        // Pendapatan hari ini
        $pendapatanHariIni = Transaksi::whereDate(
            'tgl_masuk',
            now()->toDateString()
        )->sum('total');

        // Pendapatan bulan ini
        $pendapatanBulanIni = Transaksi::whereYear(
            'tgl_masuk',
            now()->year
        )
            ->whereMonth('tgl_masuk', now()->month)
            ->sum('total');

        // Grafik pendapatan harian
        $pendapatanHarian = Transaksi::select(
            DB::raw('DATE(tgl_masuk) as tanggal'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('tgl_masuk', now()->year)
            ->groupBy(DB::raw('DATE(tgl_masuk)'))
            ->orderBy('tanggal')
            ->get();

        // Grafik pendapatan bulanan
        $pendapatanBulanan = Transaksi::select(
            DB::raw('MONTH(tgl_masuk) as bulan'),
            DB::raw('SUM(total) as total')
        )
            ->whereYear('tgl_masuk', now()->year)
            ->groupBy(DB::raw('MONTH(tgl_masuk)'))
            ->orderBy('bulan')
            ->get();

        
        // Data grafik harian untuk dashboard.js
        $grafik = $pendapatanHarian->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'total' => (float) $item->total,
            ];
        })->values();

        return view('dashboard', compact(
            'totalPelanggan',
            'totalPaket',
            'totalTransaksi',
            'pendapatanHariIni',
            'pendapatanBulanIni',
            'pendapatanHarian',
            'pendapatanBulanan',
            'grafik'
        ));
    }
}