
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transaksi - Kay Laundry</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaksi-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-dropdown.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3 2 12h3v8h5v-5h4v5h5v-8h3z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('pelanggan.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="8" r="3.5"/>
                        <path d="M2 20c0-3.6 3.1-6 7-6s7 2.4 7 6z"/>
                        <circle cx="17.5" cy="8.5" r="2.7"/>
                        <path d="M17.5 14c2.8 0 5 1.8 5 4.5V20H18v-1.5c0-1.8-.6-3.3-1.7-4.4.4-.1.8-.1 1.2-.1z"/>
                    </svg>
                    <span>Pelanggan</span>
                </a>

                <a href="{{ route('paket.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7 2h2v2h6V2h2v2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2zM5 9v11h14V9z"/>
                        <rect x="7" y="12" width="4" height="3"/>
                    </svg>
                    <span>Paket Laundry</span>
                </a>

                <a href="{{ route('transaksi.index') }}" class="sidebar-link active">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm2 5v2h10V8zm0 4v2h10v-2zm0 4v2h6v-2z"/>
                    </svg>
                    <span>Transaksi</span>
                </a>

                <a href="{{ route('laporan.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2h8l6 6v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V9h5.5z"/>
                    </svg>
                    <span>Laporan</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
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

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                <button class="toggle-btn"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Buka atau tutup sidebar"
                        aria-controls="sidebarMenu"
                        aria-expanded="true">
                    <svg width="20" height="20"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="#0F2A4A"
                         stroke-width="2">
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

            <!-- CONTENT AREA -->
            <section class="dashboard-content">

                <div class="page-header-flex">
                    <div>
                        <h1 class="page-title">Data Transaksi</h1>
                    </div>

                    <button type="button"
                            class="btn-primary"
                            id="openTambahTransaksi">
                        + Tambah Transaksi
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- TABLE CARD -->
                <div class="transaksi-table-card">

                    <div class="transaksi-search-wrapper">
                        <div class="transaksi-search-box">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="7"
                                        stroke="currentColor" stroke-width="2"/>
                                <path d="M20 20L16.65 16.65"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"/>
                            </svg>

                            <input type="text"
                                   id="searchTransaksi"
                                   placeholder="Cari nama pelanggan..."
                                   autocomplete="off">
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="transaksi-table-wrapper">

                        <table class="custom-table transaksi-table"
                               id="tabelTransaksi">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Paket</th>
                                    <th>Harga</th>
                                    <th class="aksi-column">Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="transaksiTableBody">

                                @forelse($transaksi as $item)
                                    <tr class="transaksi-data-row">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            @if($item->tgl_masuk)
                                                {{ $item->tgl_masuk->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            {{ $item->pelanggan->nama ?? '-' }}
                                        </td>

                                        <!-- PAKET: NAMA PAKET DIGABUNG -->
                                        <td>
                                            @if($item->detailTransaksi && $item->detailTransaksi->count())
                                                <div class="transaksi-paket-list">
                                                    {{ $item->detailTransaksi->pluck('paket.nama_paket')->filter()->implode(', ') ?: '-' }}
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <!-- HARGA: TOTAL SEMUA PAKET -->
                                        <td>
                                            @if($item->detailTransaksi && $item->detailTransaksi->count())
                                                <div class="transaksi-harga-list">
                                                    Rp {{ number_format($item->detailTransaksi->sum('harga'), 0, ',', '.') }}
                                                </div>
                                            @else
                                                Rp 0
                                            @endif
                                        </td>

                                        <td class="aksi-column">
                                            <div class="transaksi-action-buttons">

                                                <!-- EDIT / DETAIL -->
                                                <a href="{{ route('transaksi.show', $item->id_transaksi) }}"
                                                   class="transaksi-action-btn transaksi-action-edit"
                                                   title="Edit / Detail">
                                                    <svg viewBox="0 0 24 24"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 20H21"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path d="M16.5 3.5C17.3284 2.67157 18.6716 2.67157 19.5 3.5C20.3284 4.32843 20.3284 5.67157 19.5 6.5L8 18L3 19L4 14L16.5 3.5Z"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </a>

                                                <!-- HAPUS: MEMBUKA MODAL -->
                                                <button type="button"
                                                        class="transaksi-action-btn transaksi-action-delete btn-hapus-transaksi"
                                                        data-id="{{ $item->id_transaksi }}"
                                                        data-nama="{{ $item->pelanggan->nama ?? 'pelanggan ini' }}"
                                                        data-url="{{ route('transaksi.destroy', $item->id_transaksi) }}"
                                                        title="Hapus">
                                                    <svg viewBox="0 0 24 24"
                                                         fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4 7H20"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path d="M10 11V17"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path d="M14 11V17"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"/>
                                                        <path d="M6 7L7 20H17L18 7"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linejoin="round"/>
                                                        <path d="M9 7V4H15V7"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </button>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="text-center transaksi-empty">
                                            Belum ada data transaksi.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="transaksi-pagination-footer">

                        <div class="transaksi-pagination-info">
                            Menampilkan
                            <strong>
                                {{ $transaksi->count() > 0 ? '1 - ' . $transaksi->count() : '0' }}
                            </strong>
                            dari
                            <strong>{{ $transaksi->count() }}</strong>
                            data
                        </div>

                        <div class="transaksi-pagination">
                            <button type="button"
                                    class="pagination-btn pagination-arrow"
                                    disabled>‹</button>

                            <button type="button"
                                    class="pagination-btn active">1</button>

                            <button type="button"
                                    class="pagination-btn pagination-arrow"
                                    disabled>›</button>
                        </div>

                    </div>

                </div>

            </section>
        </main>
    </div>

    <!-- MODAL TAMBAH TRANSAKSI: DIPERTAHANKAN -->
    <div class="modal-backdrop" id="modalTambahTransaksi">

        <div class="modal-box">

            <div class="modal-header">
                <div>
                    <h3>Tambah Transaksi</h3>
                </div>

                <button type="button"
                        class="modal-close"
                        id="closeTambahTransaksi">
                    &times;
                </button>
            </div>

            <form action="{{ route('transaksi.store') }}"
                  method="POST"
                  id="formTransaksi">

                @csrf

                <div class="modal-body">

                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal</label>

                        <input type="text"
                               id="tgl_masuk"
                               name="tgl_masuk_display"
                               placeholder="dd/mm/yyyy"
                               value="{{ date('d/m/Y') }}"
                               inputmode="numeric"
                               autocomplete="off"
                               required>

                        <input type="hidden"
                               id="tgl_masuk_iso"
                               name="tgl_masuk"
                               value="{{ date('Y-m-d') }}">
                    </div>

                    <!-- PELANGGAN -->
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>

                        <select id="id_pelanggan"
                                name="id_pelanggan"
                                required>
                            <option value="">-- Pilih Pelanggan --</option>

                            @foreach($pelanggan as $item)
                                <option value="{{ $item->id_pelanggan }}">
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- DETAIL PAKET -->
                    <div id="detailPaketContainer">

                        <div class="detail-paket-row" data-row="0">

                            <div class="form-group">
                                <label>Paket</label>

                                <select name="items[0][id_paket]"
                                        class="paket-select"
                                        required>
                                    <option value="">-- Pilih Paket --</option>

                                    @foreach($paket as $item)
                                        <option value="{{ $item->id_paket }}"
                                                data-harga="{{ $item->harga }}">
                                            {{ $item->nama_paket }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Berat</label>

                                <input type="number"
                                       name="items[0][berat]"
                                       class="paket-berat"
                                       min="0.01"
                                       step="0.01"
                                       placeholder="Berat"
                                       required>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>

                                <input type="text"
                                       class="paket-harga"
                                       value="Rp 0"
                                       readonly>
                            </div>

                            <button type="button"
                                    class="btn-hapus-paket"
                                    disabled>
                                &times;
                            </button>

                        </div>
                    </div>

                    <!-- TAMBAH PAKET -->
                    <button type="button"
                            class="btn-primary"
                            id="btnTambahPaket">
                        + Tambah Paket
                    </button>

                    <!-- TOTAL -->
                    <div class="transaksi-total-section">
                        <span class="transaksi-total-label">Total</span>

                        <strong id="totalTransaksi"
                                class="transaksi-total-value">
                            Rp 0
                        </strong>
                    </div>

                    <input type="hidden"
                           name="total"
                           id="totalInput"
                           value="0">

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-secondary"
                            id="cancelTambahTransaksi">
                        Batal
                    </button>

                    <button type="submit" class="btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS TRANSAKSI -->
    <div class="modal-overlay" id="modalHapusTransaksi">

        <div class="modal-card"
             role="dialog"
             aria-modal="true"
             aria-labelledby="judulHapusTransaksi">

            <div class="hapus-icon">
                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="m19 6-1 14H6L5 6"></path>
                    <path d="M10 11v6"></path>
                    <path d="M14 11v6"></path>
                    <path d="M9 6V4h6v2"></path>
                </svg>
            </div>

            <h2 id="judulHapusTransaksi">Konfirmasi Hapus</h2>

            <p>
                Apakah kamu yakin ingin menghapus transaksi pelanggan
                <strong id="namaTransaksiHapus"></strong>?
            </p>

            <form id="formHapusTransaksi" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-footer">
                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            id="batalHapusTransaksi">
                        Batal
                    </button>

                    <button type="submit"
                            class="modal-btn modal-btn-danger">
                        Hapus
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- JAVASCRIPT KALENDER -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

    <!-- JAVASCRIPT TRANSAKSI -->
    <script src="{{ asset('js/transaksi.js') }}"></script>
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>

</body>
</html>
