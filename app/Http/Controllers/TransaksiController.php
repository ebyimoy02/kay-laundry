<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\PaketLaundry;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    
/**
 * Menampilkan halaman data transaksi.
 */

public function index(Request $request)
{
    // Ambil kata kunci pencarian nama pelanggan.
    $keyword = trim($request->query('q', ''));

    // Ambil filter status pembayaran.
    $statusPembayaran = $request->query(
        'status_pembayaran',
        ''
    );

    // Ambil filter tanggal transaksi.
    $tanggal = $request->query('tanggal', '');

    // Ambil data transaksi beserta relasinya.
    $query = Transaksi::with([
        'pelanggan',
        'detailTransaksi.paket',
    ]);

    // Pencarian berdasarkan nama pelanggan.
    if ($keyword !== '') {
        $query->whereHas('pelanggan', function ($pelangganQuery) use ($keyword) {
            $pelangganQuery->where(
                'nama',
                'like',
                '%' . $keyword . '%'
            );
        });
    }

    // Filter berdasarkan status pembayaran.
    if (in_array($statusPembayaran, ['Lunas', 'Belum Bayar'], true)) {
        $query->where(
            'status_pembayaran',
            $statusPembayaran
        );
    }

    // Filter berdasarkan satu tanggal transaksi.
    if ($tanggal !== '') {
        $request->validate([
            'tanggal' => ['date_format:Y-m-d'],
        ]);

        $query->whereDate('tgl_masuk', $tanggal);
    }

    // Urutkan transaksi terbaru dan pertahankan semua filter.
    $transaksi = $query
        ->orderBy('id_transaksi', 'desc')
        ->paginate(10)
        ->withQueryString();

    $pelanggan = Pelanggan::orderBy(
        'nama',
        'asc'
    )->get();

    $paket = PaketLaundry::orderBy(
        'nama_paket',
        'asc'
    )->get();

    return view(
        'transaksi.index',
        compact(
            'transaksi',
            'pelanggan',
            'paket'
        )
    );
}

    /**
     * Menampilkan halaman create transaksi.
     */
    public function create()
    {
        $pelanggan = Pelanggan::orderBy(
            'nama',
            'asc'
        )->get();

        $paket = PaketLaundry::orderBy(
            'nama_paket',
            'asc'
        )->get();

        return view(
            'transaksi.create',
            compact(
                'pelanggan',
                'paket'
            )
        );
    }

    /**
     * Menyimpan transaksi beserta detail paket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => [
                'required',
                'exists:pelanggan,id_pelanggan',
            ],

            'tgl_masuk' => [
                'required',
                'date',
            ],

            'tgl_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tgl_masuk',
            ],

            'status_pembayaran' => [
                'sometimes',
                'required',
                'in:Lunas,Belum Bayar',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.id_paket' => [
                'required',
                'exists:paket_laundry,id_paket',
            ],

            'items.*.berat' => [
                'required',
                'numeric',
                'min:0.01',
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $total = 0;

            $transaksi = Transaksi::create([
                'id_admin' => session('admin_id')
                    ?? data_get(session('admin'), 'id_admin'),

                'id_pelanggan' =>
                    $validated['id_pelanggan'],

                'tgl_masuk' =>
                    $validated['tgl_masuk'],

                'tgl_selesai' =>
                    $validated['tgl_selesai'] ?? null,

                'total' => 0,

                'status_pembayaran' =>
                    $validated['status_pembayaran']
                    ?? 'Belum Lunas',
            ]);

            foreach ($validated['items'] as $item) {
                $paket = PaketLaundry::findOrFail(
                    $item['id_paket']
                );

                $berat = (float) $item['berat'];
                $harga = (float) $paket->harga;
                $subtotal = $berat * $harga;

                DetailTransaksi::create([
                    'id_transaksi' =>
                        $transaksi->id_transaksi,

                    'id_paket' =>
                        $paket->id_paket,

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
            ->with(
                'success',
                'Transaksi berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan halaman edit transaksi.
     */
    public function edit(Transaksi $transaksi)
    {
        $transaksi->load([
            'pelanggan',
            'detailTransaksi.paket',
        ]);

        $pelanggan = Pelanggan::orderBy(
            'nama',
            'asc'
        )->get();

        $paket = PaketLaundry::orderBy(
            'nama_paket',
            'asc'
        )->get();

        return view(
            'transaksi.edit',
            compact(
                'transaksi',
                'pelanggan',
                'paket'
            )
        );
    }

    /**
     * Memperbarui seluruh data transaksi.
     */
    public function update(
        Request $request,
        Transaksi $transaksi
    ) {
        $validated = $request->validate([
            'id_pelanggan' => [
                'required',
                'exists:pelanggan,id_pelanggan',
            ],

            'tgl_masuk' => [
                'required',
                'date',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.id_paket' => [
                'required',
                'exists:paket_laundry,id_paket',
            ],

            'items.*.berat' => [
                'required',
                'numeric',
                'min:0.01',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $transaksi
        ) {
            // Perbarui pelanggan dan tanggal masuk.
            // Status pembayaran tidak diubah di sini.
            $transaksi->update([
                'id_pelanggan' =>
                    $validated['id_pelanggan'],

                'tgl_masuk' =>
                    $validated['tgl_masuk'],
            ]);

            // Hapus detail paket lama.
            $transaksi->detailTransaksi()->delete();

            $total = 0;

            // Simpan kembali seluruh paket dari form.
            foreach ($validated['items'] as $item) {
                $paket = PaketLaundry::findOrFail(
                    $item['id_paket']
                );

                $berat = (float) $item['berat'];
                $harga = (float) $paket->harga;
                $subtotal = $berat * $harga;

                DetailTransaksi::create([
                    'id_transaksi' =>
                        $transaksi->id_transaksi,

                    'id_paket' =>
                        $paket->id_paket,

                    'berat' => $berat,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            // Perbarui total berdasarkan detail terbaru.
            $transaksi->update([
                'total' => $total,
            ]);
        });

        return redirect()
            ->route(
                'transaksi.show',
                $transaksi->id_transaksi
            )
            ->with(
                'success',
                'Transaksi berhasil diperbarui.'
            );
    }

    /**
     * Menampilkan detail transaksi.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load([
            'pelanggan',
            'admin',
            'detailTransaksi.paket',
        ]);

        return view(
            'transaksi.show',
            compact('transaksi')
        );
    }

    /**
     * Menghapus transaksi.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with(
                'success',
                'Transaksi berhasil dihapus.'
            );
    }

    /**
     * Memperbarui status pembayaran transaksi.
     */
    public function updatePembayaran(
        Request $request,
        Transaksi $transaksi
    ) {
        $validated = $request->validate([
            'status_pembayaran' => [
                'required',
                'in:Lunas,Belum Bayar',
            ],
        ]);

        $transaksi->update([
            'status_pembayaran' =>
                $validated['status_pembayaran'],
        ]);

        return redirect()
            ->route('transaksi.index')
            ->with(
                'success',
                'Status pembayaran berhasil diperbarui.'
            );
    }
}