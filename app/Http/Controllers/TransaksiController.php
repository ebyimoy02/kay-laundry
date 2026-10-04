<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pelanggan;
use App\Models\PaketLaundry;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with([
            'admin',
            'pelanggan',
            'detailTransaksi.paketLaundry'
        ])
            ->orderBy('id_transaksi', 'desc')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::orderBy('nama')->get();

        $paket = PaketLaundry::orderBy('nama_paket')->get();

        $admin = Admin::orderBy('username')->get();

        return view('transaksi.create', compact(
            'pelanggan',
            'paket',
            'admin'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_admin' => 'required|exists:admin,id_admin',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'tgl_masuk' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_masuk',

            'detail' => 'required|array|min:1',

            'detail.*.id_paket' => [
                'required',
                'exists:paket_laundry,id_paket',
            ],

            'detail.*.berat' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {

            $transaksi = Transaksi::create([
                'id_admin' => $validated['id_admin'],
                'id_pelanggan' => $validated['id_pelanggan'],
                'tgl_masuk' => $validated['tgl_masuk'],
                'tgl_selesai' => $validated['tgl_selesai'],
                'total' => 0,
            ]);

            $total = 0;

            foreach ($validated['detail'] as $item) {

                $paket = PaketLaundry::findOrFail(
                    $item['id_paket']
                );

                $berat = $item['berat'];

                $harga = $paket->harga;

                $subtotal = $berat * $harga;

                $transaksi->detailTransaksi()->create([
                    'id_paket' => $paket->id_paket,
                    'berat' => $berat,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $transaksi->update([
                'total' => $total,
            ]);
        });

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load([
            'admin',
            'pelanggan',
            'detailTransaksi.paketLaundry'
        ]);

        return view('transaksi.show', compact('transaksi'));
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}