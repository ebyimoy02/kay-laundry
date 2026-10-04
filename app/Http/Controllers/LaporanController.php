<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;

        $query = Transaksi::with([
            'pelanggan',
            'admin',
            'detailTransaksi.paketLaundry'
        ]);

        if ($tanggalMulai) {
            $query->whereDate('tgl_masuk', '>=', $tanggalMulai);
        }

        if ($tanggalSelesai) {
            $query->whereDate('tgl_masuk', '<=', $tanggalSelesai);
        }

        $transaksi = $query
            ->orderBy('tgl_masuk', 'desc')
            ->get();

        $totalTransaksi = $transaksi->count();

        $totalPendapatan = $transaksi->sum('total');

        return view('laporan.index', compact(
            'transaksi',
            'totalTransaksi',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}