
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('content')
<div class="laporan-page">

    <!-- CARD UTAMA -->
    <div class="laporan-card">

        <!-- HEADER DAN PERIODE -->
        <div class="laporan-header">

            <h1 class="laporan-title">Laporan</h1>

            <form action="{{ route('laporan.index') }}"
                  method="GET"
                  class="laporan-filter">

                <span class="laporan-periode-label">PERIODE</span>

                <!-- TANGGAL AWAL -->
                <input type="text"
                       id="tanggal_mulai_display"
                       class="laporan-date-input"
                       placeholder="dd/mm/yyyy"
                       autocomplete="off"
                       required>

                <input type="hidden"
                       name="tanggal_mulai"
                       id="tanggal_mulai"
                       value="{{ request('tanggal_mulai', $tanggalMulai ?? '') }}">

                <!-- TANGGAL AKHIR -->
                <input type="text"
                       id="tanggal_selesai_display"
                       class="laporan-date-input"
                       placeholder="dd/mm/yyyy"
                       autocomplete="off"
                       required>

                <input type="hidden"
                       name="tanggal_selesai"
                       id="tanggal_selesai"
                       value="{{ request('tanggal_selesai', $tanggalSelesai ?? '') }}">

                <button type="submit" class="laporan-btn-tampilkan">
                    Tampilkan
                </button>

            </form>
        </div>

        <!-- TABEL LAPORAN -->
        <div class="laporan-table-wrapper">

            <table class="laporan-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksi as $index => $item)
                        <tr>

                            <td style="text-align: center;">
                                {{ $transaksi->firstItem() + $index }}
                            </td>

                            <!-- TANGGAL TRANSAKSI -->
                            <td>
                                {{ $item->tgl_masuk
                                    ? \Carbon\Carbon::parse($item->tgl_masuk)->format('d/m/Y')
                                    : '-' }}
                            </td>

                            <!-- PELANGGAN -->
                            <td>
                                {{ $item->pelanggan->nama ?? '-' }}
                            </td>

                            <!-- PAKET -->
                            <td>
                                <div class="laporan-detail-list">
                                    @forelse($item->detailTransaksi as $detail)
                                        <div>
                                            {{ $detail->paket->nama_paket ?? '-' }}
                                        </div>
                                    @empty
                                        -
                                    @endforelse
                                </div>
                            </td>

                            <!-- BERAT -->
                            <td>
                                <div class="laporan-detail-list">
                                    @forelse($item->detailTransaksi as $detail)
                                        <div>
                                            {{ number_format((float) $detail->berat, 2, ',', '.') }} Kg
                                        </div>
                                    @empty
                                        -
                                    @endforelse
                                </div>
                            </td>

                            <!-- HARGA -->
                            <td>
                                <div class="laporan-detail-list">
                                    @forelse($item->detailTransaksi as $detail)
                                        <div>
                                            Rp {{ number_format((float) $detail->harga, 0, ',', '.') }}
                                        </div>
                                    @empty
                                        -
                                    @endforelse
                                </div>
                            </td>

                            <!-- TOTAL TRANSAKSI -->
                            <td style="font-weight: 700; white-space: nowrap;">
                                Rp {{ number_format((float) $item->total, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="laporan-empty">
                                Belum ada data transaksi.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            
            </table>
        </div>

                <!-- PAGINATION -->
        @if ($transaksi->hasPages())
            <div class="laporan-pagination">
                <div class="laporan-pagination-info">
                    Menampilkan
                    <strong>{{ $transaksi->firstItem() }}–{{ $transaksi->lastItem() }}</strong>
                    dari
                    <strong>{{ $transaksi->total() }}</strong>
                    data
                </div>

                {{ $transaksi->links() }}
            </div>
        @endif

        <!-- TOTAL PENDAPATAN -->
        <div class="laporan-total">

            <span>Total Pendapatan</span>

            <strong>
                Rp {{ number_format((float) $totalPendapatan, 0, ',', '.') }}
            </strong>

        </div>

    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script src="{{ asset('js/laporan.js') }}"></script>
@endpush
