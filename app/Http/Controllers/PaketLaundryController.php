<?php

namespace App\Http\Controllers;

use App\Models\PaketLaundry;
use Illuminate\Http\Request;

class PaketLaundryController extends Controller
{
    public function index()
    {
        $paket = PaketLaundry::orderBy(
            'id_paket',
            'desc'
        )->get();

        return view(
            'paket.index',
            compact('paket')
        );
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
        ]);

        PaketLaundry::create($validated);

        return redirect()
            ->route('paket.index')
            ->with(
                'success',
                'Data paket laundry berhasil ditambahkan.'
            );
    }

    public function edit(PaketLaundry $paket)
    {
        return view(
            'paket.edit',
            compact('paket')
        );
    }

    public function update(
        Request $request,
        PaketLaundry $paket
    ) {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:20',
        ]);

        $paket->update($validated);

        return redirect()
            ->route('paket.index')
            ->with(
                'success',
                'Data paket laundry berhasil diperbarui.'
            );
    }

    public function destroy(PaketLaundry $paket)
    {
        $paket->delete();

        return redirect()
            ->route('paket.index')
            ->with(
                'success',
                'Data paket laundry berhasil dihapus.'
            );
    }
}