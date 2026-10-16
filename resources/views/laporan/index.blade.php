@extends('layouts.app')

@section('content')
<div class="px-8 py-6">
    <!-- Card Utama Pembungkus Halaman Laporan -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        
        <!-- Header Judul & Filter Periode Sejajar di Kanan -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h1 class="text-2xl font-bold text-[#0b2553]">Laporan</h1>
            
            <!-- Form Filter Tanggal & Tombol Tampilkan -->
            <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mr-1">PERIODE</span>
                <div class="relative">
                    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#0b2553]">
                </div>
                <div class="relative">
                    <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#0b2553]">
                </div>
                <button type="submit" class="bg-[#0b2553] hover:bg-[#15386d] text-white px-5 py-1.5 rounded-lg text-sm font-semibold shadow-sm transition">
                    Tampilkan
                </button>
            </form>
        </div>

        <!-- Tabel Data Laporan Transaksi -->
        <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#f0f4f8] text-[#0b2553] text-sm font-bold border-b border-gray-200">
                        <th class="py-3.5 px-6 w-16 text-center">No</th>
                        <th class="py-3.5 px-6">Tanggal</th>
                        <th class="py-3.5 px-6">Pelanggan</th>
                        <th class="py-3.5 px-6">Paket</th>
                        <th class="py-3.5 px-6">Berat</th>
                        <th class="py-3.5 px-6">Harga</th>
                        <th class="py-3.5 px-6">Total</th>
                    </tr>
                </thead>
<tbody class="divide-y divide-gray-200 text-sm text-gray-700">
    @forelse($transaksi as $index => $item)
        <tr class="hover:bg-gray-50 transition">
            <td class="py-4 px-6 text-center text-gray-600">
                {{ $index + 1 }}
            </td>

            <td class="py-4 px-6">
                {{ $item->tgl_masuk ? \Carbon\Carbon::parse($item->tgl_masuk)->format('Y-m-d') : '-' }}
            </td>

            <td class="py-4 px-6 font-medium text-gray-900">
                {{ $item->pelanggan->nama ?? '-' }}
            </td>

            <td class="py-4 px-6">
                @forelse($item->detailTransaksi as $detail)
                    <div>{{ $detail->paket->nama_paket ?? '-' }}</div>
                @empty
                    -
                @endforelse
            </td>

            <td class="py-4 px-6">
                @forelse($item->detailTransaksi as $detail)
                    <div>{{ number_format((float) $detail->berat, 2, ',', '.') }} Kg</div>
                @empty
                    -
                @endforelse
            </td>

            <td class="py-4 px-6">
                @forelse($item->detailTransaksi as $detail)
                    <div>Rp {{ number_format((float) $detail->harga, 0, ',', '.') }}</div>
                @empty
                    -
                @endforelse
            </td>

            <td class="py-4 px-6 font-medium text-gray-900">
                Rp {{ number_format((float) $item->total, 0, ',', '.') }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="py-6 px-6 text-center text-gray-500">
                Belum ada data transaksi.
            </td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>

        <!-- Bagian Total Pendapatan di Bawah Di dalam Card -->
        <div class="flex justify-between items-center pt-2 px-2">
            <span class="text-base font-bold text-[#0b2553]">Total Pendapatan</span>
            Rp {{ number_format((float) $totalPendapatan, 0, ',', '.') }}
        </div>

    </div>
</div>
@endsection