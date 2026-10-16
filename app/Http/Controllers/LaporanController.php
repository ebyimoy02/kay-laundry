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

        $transaksi = $query->get();

        $totalTransaksi = $transaksi->count();

        $totalPendapatan = $transaksi->sum(function ($item) {
            return (float) $item->total;
        });

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