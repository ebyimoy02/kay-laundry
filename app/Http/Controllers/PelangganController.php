<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    
public function index(Request $request)
{
    $query = Pelanggan::query();

    // Pencarian berdasarkan nama atau nomor HP
    if ($request->filled('q')) {
        $keyword = $request->q;

        $query->where(function ($subQuery) use ($keyword) {
            $subQuery->where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('no_hp', 'like', '%' . $keyword . '%');
        });
    }

    // Maksimal 10 data per halaman
    $pelanggan = $query
        ->orderBy('id_pelanggan', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('pelanggan.index', compact('pelanggan'));
}

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil ditambahkan.'
            );
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view(
            'pelanggan.edit',
            compact('pelanggan')
        );
    }

    public function update(
        Request $request,
        Pelanggan $pelanggan
    ) {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil diperbarui.'
            );
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil dihapus.'
            );
    }
}