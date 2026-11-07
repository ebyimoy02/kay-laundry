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

    <div class="laporan-header-actions">

        <form action="{{ route('laporan.index') }}"
              method="GET"
              class="laporan-filter">

            <span class="laporan-periode-label">PERIODE</span>

            <select name="periode" id="periode_laporan" class="laporan-date-input">
                <option value="semua" {{ ($periode ?? 'bulanan') == 'semua' ? 'selected' : '' }}>Semua Data</option>
                <option value="mingguan" {{ ($periode ?? 'bulanan') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                <option value="bulanan" {{ ($periode ?? 'bulanan') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                <option value="tahunan" {{ ($periode ?? 'bulanan') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                <option value="rentang" {{ ($periode ?? 'bulanan') == 'rentang' ? 'selected' : '' }}>Rentang Tanggal</option>
            </select>

            <!-- PILIH MINGGU -->
            <input type="date"
                   name="tanggal_acuan"
                   id="tanggal_acuan"
                   class="laporan-date-input"
                   value="{{ $tanggalAcuan ?? now()->toDateString() }}">

            <!-- PILIH BULAN -->
            <input type="month"
                   name="bulan"
                   id="bulan_laporan"
                   class="laporan-date-input"
                   value="{{ $bulan ?? now()->format('Y-m') }}">

            <!-- PILIH TAHUN -->
            <input type="number"
                   name="tahun"
                   id="tahun_laporan"
                   class="laporan-date-input"
                   min="2000"
                   max="{{ now()->year }}"
                   value="{{ $tahun ?? now()->year }}">

            <!-- RENTANG TANGGAL -->
            <input type="text"
                   id="tanggal_mulai_display"
                   class="laporan-date-input"
                   placeholder="dd/mm/yyyy"
                   autocomplete="off">

            <input type="hidden"
                   name="tanggal_mulai"
                   id="tanggal_mulai"
                   value="{{ $tanggalMulai ?? '' }}">

            <input type="text"
                   id="tanggal_selesai_display"
                   class="laporan-date-input"
                   placeholder="dd/mm/yyyy"
                   autocomplete="off">

            <input type="hidden"
                   name="tanggal_selesai"
                   id="tanggal_selesai"
                   value="{{ $tanggalSelesai ?? '' }}">

            <button type="submit" class="laporan-btn-tampilkan">
                Tampilkan
            </button>

        </form>

        <a href="{{ route('laporan.cetak', request()->only([
        'periode',
        'tanggal_acuan',
        'bulan',
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'q'
        ])) }}"
   class="laporan-btn-tampilkan">
    Cetak
</a>

    </div>

</div>

<!-- PENCARIAN LAPORAN -->
<form action="{{ route('laporan.index') }}"
      method="GET"
      class="laporan-search-form">

    <!-- Pertahankan filter periode -->
    <input type="hidden" name="periode" value="{{ request('periode', $periode ?? 'bulanan') }}">
    <input type="hidden" name="tanggal_acuan" value="{{ request('tanggal_acuan', $tanggalAcuan ?? now()->toDateString()) }}">
    <input type="hidden" name="bulan" value="{{ request('bulan', $bulan ?? now()->format('Y-m')) }}">
    <input type="hidden" name="tahun" value="{{ request('tahun', $tahun ?? now()->year) }}">
    <input type="hidden" name="tanggal_mulai" value="{{ request('tanggal_mulai', '') }}">
    <input type="hidden" name="tanggal_selesai" value="{{ request('tanggal_selesai', '') }}">

    <div class="laporan-search-box">
        <svg xmlns="http://www.w3.org/2000/svg"
             width="20"
             height="20"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
             aria-hidden="true">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
        </svg>

        <input type="text"
               name="q"
               value="{{ $keyword ?? request('q', '') }}"
               placeholder="Cari nama pelanggan atau paket laundry..."
               aria-label="Cari nama pelanggan atau paket laundry">
    </div>

    <button type="submit" class="laporan-btn-cari">
        Cari
    </button>

    @if(request()->filled('q'))
        <a href="{{ route('laporan.index', array_filter([
            'periode' => request('periode', $periode ?? 'bulanan'),
            'tanggal_acuan' => request('tanggal_acuan', $tanggalAcuan ?? ''),
            'bulan' => request('bulan', $bulan ?? ''),
            'tahun' => request('tahun', $tahun ?? ''),
            'tanggal_mulai' => request('tanggal_mulai'),
            'tanggal_selesai' => request('tanggal_selesai'),
        ], fn ($value) => $value !== null && $value !== '')) }}"
           class="laporan-btn-reset">
            Reset
        </a>
    @endif

</form>

        <!-- TABEL LAPORAN -->
        <div class="laporan-table-wrapper">

            <table class="laporan-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Jumlah</th>
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
           
<!-- JUMLAH -->
<td>
    <div class="laporan-detail-list">
        @forelse($item->detailTransaksi as $detail)
            <div>
                {{ number_format((float) $detail->berat, 2, ',', '.') }}
                {{ $detail->paket->satuan ?? '' }}
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