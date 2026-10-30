<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\PaketLaundry;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    
public function index(Request $request)
{
    $tanggalMulai = $request->tanggal_mulai;
    $tanggalSelesai = $request->tanggal_selesai;

    $query = Transaksi::with([
        'pelanggan',
        'detailTransaksi.paket'
    ])->orderBy('tgl_masuk', 'desc');

    if ($tanggalMulai) {
        $query->whereDate('tgl_masuk', '>=', $tanggalMulai);
    }

    if ($tanggalSelesai) {
        $query->whereDate('tgl_masuk', '<=', $tanggalSelesai);
    }

    // Hitung semua transaksi sesuai filter periode
    $totalTransaksi = (clone $query)->count();

    $totalPendapatan = (clone $query)->sum('total');

    // Tampilkan maksimal 10 transaksi per halaman
    $transaksi = $query->paginate(10)->withQueryString();

    $totalPelanggan = Pelanggan::count();
    $totalPaket = PaketLaundry::count();

    return view('laporan.index', compact(
        'transaksi',
        'totalTransaksi',
        'totalPendapatan',
        'totalPelanggan',
        'totalPaket',
        'tanggalMulai',
        'tanggalSelesai'
    ));
}

}