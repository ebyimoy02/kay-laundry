<?php

namespace App\Http\Controllers;

use App\Models\PaketLaundry;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaketLaundryController extends Controller
{
    /**
     * Tampilkan daftar paket.
     */
    
public function index(Request $request)
{
    $query = PaketLaundry::query();

    // Pencarian berdasarkan nama paket
    if ($request->filled('q')) {
        $keyword = $request->q;

        $query->where(
            'nama_paket',
            'like',
            '%' . $keyword . '%'
        );
    }

    // Maksimal 10 data per halaman
    $paket = $query
        ->orderBy('id_paket')
        ->paginate(10)
        ->withQueryString();

    return view('paket.index', compact('paket'));
}


    /**
     * Simpan paket baru.
     */
    public function store(Request $request)
    {
        PaketLaundry::create($this->validated($request));

        return redirect()
            ->route('paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Perbarui paket.
     */
    public function update(Request $request, PaketLaundry $paket)
    {
        $paket->update($this->validated($request));

        return redirect()
            ->route('paket.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Hapus paket.
     */
    public function destroy(PaketLaundry $paket)
    {
        try {
            $paket->delete();
        } catch (QueryException $e) {
            // Biasanya karena paket masih dipakai di data transaksi (foreign key).
            return redirect()
                ->route('paket.index')
                ->with('error', 'Paket tidak dapat dihapus karena masih digunakan pada transaksi.');
        }

        return redirect()
            ->route('paket.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    /**
     * Aturan validasi yang dipakai store() dan update().
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_paket' => ['required', 'string', 'max:100'],
            'harga'      => ['required', 'numeric', 'min:0'],
            'satuan'     => ['required', 'string', 'max:20'],
        ]);
    }
}