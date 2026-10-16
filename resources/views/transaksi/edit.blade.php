<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Transaksi - Kay Laundry</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaksi-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit-transaksi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-dropdown.css') }}">

<style>
    .edit-transaksi-card {
        box-sizing: border-box;
        width: 100%;
        padding: 24px;
        background: #fff;
        border-radius: 12px;
    }

    .edit-transaksi-card .edit-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
    }

    .edit-transaksi-card .edit-field label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #26384d;
    }

    .edit-transaksi-card .edit-field select,
    .edit-transaksi-card .edit-field input {
        box-sizing: border-box;
        width: 100%;
        min-width: 0;
        min-height: 42px;
        padding: 10px 12px;
        border: 1px solid #d5deea;
        border-radius: 7px;
        background: #fff;
        color: #26384d;
        font-family: inherit;
        font-size: 14px;
    }

    .edit-transaksi-card .edit-field input[readonly] {
        background: #f5f7fa;
    }

    /* BARIS DETAIL PAKET */
    .edit-transaksi-card .edit-paket-row {
        display: grid;
        grid-template-columns:
            minmax(0, 1.5fr)
            minmax(100px, .8fr)
            minmax(130px, 1fr)
            max-content;
        align-items: end;
        gap: 16px;
        margin-bottom: 16px;
        padding: 18px;
        border: 1px solid #e0e7f0;
        border-radius: 10px;
        background: #fbfcfe;
    }

    .edit-transaksi-card .edit-paket-row .modal-form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
        margin: 0;
    }

    /* TOMBOL HAPUS PAKET */
    .edit-transaksi-card .edit-paket-row button.btn-hapus-paket {
        box-sizing: border-box !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        justify-self: start !important;
        align-self: end !important;

        width: max-content !important;
        min-width: 120px !important;
        max-width: none !important;
        height: 42px !important;
        min-height: 42px !important;

        margin: 0 !important;
        padding: 0 12px !important;

        border: 1px solid #d9534f !important;
        border-radius: 7px !important;
        background: #fff !important;
        color: #c0392b !important;

        font-family: inherit !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        line-height: 1.2 !important;
        white-space: nowrap !important;
        text-align: center !important;

        cursor: pointer;
        flex-shrink: 0;
    }

    .edit-transaksi-card .edit-paket-row button.btn-hapus-paket:hover {
        background: #fff1f0 !important;
    }

    .edit-transaksi-card .edit-paket-row button.btn-hapus-paket[hidden] {
        display: none !important;
    }

    /* TOTAL TRANSAKSI */
    .edit-transaksi-card .edit-total {
        max-width: 360px;
        margin-top: 24px;
    }

    /* TOMBOL AKSI */
    .edit-transaksi-card .edit-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 26px;
    }

    .edit-transaksi-card .edit-actions a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    /* TABLET */
    @media (max-width: 900px) {
        .edit-transaksi-card .edit-paket-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* HP */
    @media (max-width: 560px) {
        .edit-transaksi-card {
            padding: 16px;
        }

        .edit-transaksi-card .edit-paket-row {
            grid-template-columns: minmax(0, 1fr);
            gap: 14px;
            padding: 14px;
        }

        .edit-transaksi-card .edit-paket-row button.btn-hapus-paket {
            justify-self: start !important;
            align-self: start !important;
        }

        .edit-transaksi-card .edit-total {
            max-width: 100%;
        }

        .edit-transaksi-card .edit-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .edit-transaksi-card .edit-actions button,
        .edit-transaksi-card .edit-actions a {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>
</head>

<body class="dashboard-page">

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebarMenu">

            <div class="sidebar-brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 100 120"
                         fill="none"
                         stroke="#ffffff"
                         stroke-width="7"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect x="4" y="4" width="92" height="112" rx="10"/>
                        <line x1="4" y1="30" x2="96" y2="30"/>
                        <circle cx="22" cy="17" r="3.2" fill="#ffffff" stroke="none"/>
                        <circle cx="36" cy="17" r="3.2" fill="#ffffff" stroke="none"/>
                        <line x1="58" y1="17" x2="78" y2="17"/>
                        <circle cx="50" cy="73" r="27"/>
                        <path d="M32 75c6-7 12 7 18 0s12 7 18 0"/>
                    </svg>
                </div>
                <h2>Laundry</h2>
            </div>

            <nav class="sidebar-menu">

                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3 2 12h3v8h5v-5h4v5h5v-8h3z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('pelanggan.index') }}"
                   class="sidebar-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="8" r="3.5"/>
                        <path d="M2 20c0-3.6 3.1-6 7-6s7 2.4 7 6z"/>
                        <circle cx="17.5" cy="8.5" r="2.7"/>
                        <path d="M17.5 14c2.8 0 5 1.8 5 4.5V20H18v-1.5c0-1.8-.6-3.3-1.7-4.4.4-.1.8-.1 1.2-.1z"/>
                    </svg>
                    <span>Pelanggan</span>
                </a>

                <a href="{{ route('paket.index') }}"
                   class="sidebar-link {{ request()->routeIs('paket.*') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7 2h2v2h6V2h2v2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2zM5 9v11h14V9z"/>
                        <rect x="7" y="12" width="4" height="3"/>
                    </svg>
                    <span>Paket Laundry</span>
                </a>

                <a href="{{ route('transaksi.index') }}"
                   class="sidebar-link active">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm2 5v2h10V8zm0 4v2h10v-2zm0 4v2h6v-2z"/>
                    </svg>
                    <span>Transaksi</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                   class="sidebar-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2h8l6 6v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V9h5.5z"/>
                    </svg>
                    <span>Laporan</span>
                </a>

                <form action="{{ route('logout') }}"
                      method="POST"
                      class="logout-form">
                    @csrf

                    <button type="submit" class="sidebar-link">
                        <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5 3h6v2H5v14h6v2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/>
                            <path d="m16 7 5 5-5 5-1.4-1.4 2.6-2.6H9v-2h8.2l-2.6-2.6z"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>

            </nav>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                <button type="button"
                        class="toggle-btn"
                        id="sidebarToggle"
                        aria-label="Buka atau tutup sidebar"
                        aria-controls="sidebarMenu"
                        aria-expanded="true">

                    <svg width="20"
                         height="20"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="#0F2A4A"
                         stroke-width="2"
                         stroke-linecap="round">
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>

                </button>

                <div class="admin-profile">
                    <div class="admin-avatar">
                        <svg viewBox="0 0 24 24" fill="#ffffff">
                            <circle cx="12" cy="8" r="4.2"/>
                            <path d="M4 21c0-4.2 3.6-6.5 8-6.5s8 2.3 8 6.5v1H4z"/>
                        </svg>
                    </div>

                    <div class="admin-info">
                        <strong>Kay Laundry</strong>
                        <span>Operator</span>
                    </div>
                </div>

            </header>

            <!-- ISI HALAMAN -->
            <section class="dashboard-content">

                <div class="page-header-flex">
                    <div>
                        <h1 class="page-title">Edit Transaksi</h1>
                    </div>
                </div>

                <!-- PESAN ERROR -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM EDIT TRANSAKSI -->
                <div class="transaksi-table-card edit-transaksi-card">

                    <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}"
                          method="POST"
                          id="formEditTransaksi">

                        @csrf
                        @method('PUT')

                        <!-- PELANGGAN -->
                        <div class="modal-form-group edit-field">
                            <label for="id_pelanggan">Nama Pelanggan</label>

                            <select name="id_pelanggan"
                                    id="id_pelanggan"
                                    required>

                                <option value="">Pilih Pelanggan</option>

                                @foreach ($pelanggan as $item)
                                    <option value="{{ $item->id_pelanggan }}"
                                        {{ old('id_pelanggan', $transaksi->id_pelanggan) == $item->id_pelanggan ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- TANGGAL MASUK -->
                        <div class="modal-form-group edit-field"
                             style="margin-top: 20px;">

                            <label for="tgl_masuk">Tanggal Masuk</label>

                            <input type="date"
                                   name="tgl_masuk"
                                   id="tgl_masuk"
                                   value="{{ old('tgl_masuk', $transaksi->tgl_masuk ? \Carbon\Carbon::parse($transaksi->tgl_masuk)->format('Y-m-d') : '') }}"
                                   required>
                        </div>

                        <!-- DETAIL PAKET -->
                        <div id="detailPaketContainer" style="margin-top: 24px;">

                            @forelse ($transaksi->detailTransaksi as $index => $detail)

                                <div class="detail-paket-row edit-paket-row">

                                    <div class="modal-form-group edit-field">
                                        <label>Paket Laundry</label>

                                        <select name="items[{{ $index }}][id_paket]"
                                                class="paket-select"
                                                required>

                                            <option value="">Pilih Paket</option>

                                            @foreach ($paket as $paketItem)
                                                <option value="{{ $paketItem->id_paket }}"
                                                        data-harga="{{ $paketItem->harga }}"
                                                    {{ old("items.$index.id_paket", $detail->id_paket) == $paketItem->id_paket ? 'selected' : '' }}>
                                                    {{ $paketItem->nama_paket }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="modal-form-group edit-field">
                                        <label>Berat (kg)</label>

                                        <input type="number"
                                               name="items[{{ $index }}][berat]"
                                               class="berat-input"
                                               min="0.01"
                                               step="0.01"
                                               value="{{ old("items.$index.berat", $detail->berat) }}"
                                               required>
                                    </div>

                                    <div class="modal-form-group edit-field">
                                        <label>Harga per kg</label>

                                        <input type="text"
                                               class="harga-paket"
                                               value="Rp {{ number_format($detail->harga, 0, ',', '.') }}"
                                               readonly>
                                    </div>

                                    <button type="button"
                                            class="btn-hapus-paket"
                                            {{ $loop->first && $loop->last ? 'hidden' : '' }}>
                                        Hapus Paket
                                    </button>

                                </div>

                            @empty

                                <div class="detail-paket-row edit-paket-row">

                                    <div class="modal-form-group edit-field">
                                        <label>Paket Laundry</label>

                                        <select name="items[0][id_paket]"
                                                class="paket-select"
                                                required>
                                            <option value="">Pilih Paket</option>

                                            @foreach ($paket as $paketItem)
                                                <option value="{{ $paketItem->id_paket }}"
                                                        data-harga="{{ $paketItem->harga }}">
                                                    {{ $paketItem->nama_paket }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="modal-form-group edit-field">
                                        <label>Berat (kg)</label>

                                        <input type="number"
                                               name="items[0][berat]"
                                               class="berat-input"
                                               min="0.01"
                                               step="0.01"
                                               required>
                                    </div>

                                    <div class="modal-form-group edit-field">
                                        <label>Harga per kg</label>

                                        <input type="text"
                                               class="harga-paket"
                                               value="Rp 0"
                                               readonly>
                                    </div>

                                    <button type="button"
                                            class="btn-hapus-paket"
                                            hidden>
                                        Hapus Paket
                                    </button>

                                </div>

                            @endforelse

                        </div>

                        <!-- TOTAL -->
                        <div class="modal-form-group edit-field edit-total">
                            <label for="totalTransaksi">Total Transaksi</label>

                            <input type="text"
                                   id="totalTransaksi"
                                   value="Rp {{ number_format($transaksi->total ?? 0, 0, ',', '.') }}"
                                   readonly>
                        </div>

                        <!-- TOMBOL -->
                        <div class="edit-actions">

                            <button type="button"
                                    id="btnTambahPaket"
                                    class="btn-primary">
                                + Tambah Paket
                            </button>

                            <button type="submit"
                                    class="btn-primary">
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('transaksi.show', $transaksi->id_transaksi) }}"
                               class="btn-primary">
                                Batal
                            </a>

                        </div>

                    </form>

                </div>

            </section>

        </main>

    </div>

    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>
    <script src="{{ asset('js/edit-transaksi.js') }}"></script>

</body>
</html>