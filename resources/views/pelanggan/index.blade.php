
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Pelanggan - Kay Laundry</title>

    <!-- Font Roboto sesuai Figma -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Urutan CSS dipertahankan -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pelanggan-figma.css') }}">
</head>

<body class="dashboard-page">

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <div class="sidebar-brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 100 120"
                         fill="none" stroke="#ffffff" stroke-width="7"
                         stroke-linecap="round" stroke-linejoin="round">

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

                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3 2 12h3v8h5v-5h4v5h5v-8h3z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- PELANGGAN: AKTIF -->
                <a href="{{ route('pelanggan.index') }}" class="sidebar-link active">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="8" r="3.5"/>
                        <path d="M2 20c0-3.6 3.1-6 7-6s7 2.4 7 6z"/>
                        <circle cx="17.5" cy="8.5" r="2.7"/>
                        <path d="M17.5 14c2.8 0 5 1.8 5 4.5V20H18v-1.5c0-1.8-.6-3.3-1.7-4.4.4-.1.8-.1 1.2-.1z"/>
                    </svg>
                    <span>Pelanggan</span>
                </a>

                <!-- PAKET LAUNDRY -->
                <a href="{{ route('paket.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7 2h2v2h6V2h2v2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2zM5 9v11h14V9z"/>
                        <rect x="7" y="12" width="4" height="3"/>
                    </svg>
                    <span>Paket Laundry</span>
                </a>

                <!-- TRANSAKSI -->
                <a href="{{ route('transaksi.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm2 5v2h10V8zm0 4v2h10v-2zm0 4v2h6v-2z"/>
                    </svg>
                    <span>Transaksi</span>
                </a>

                <!-- LAPORAN -->
                <a href="{{ route('laporan.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2h8l6 6v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm7 1.5V9h5.5z"/>
                    </svg>
                    <span>Laporan</span>
                </a>

                <!-- LOGOUT -->
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

        <!-- MAIN -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                <button type="button" class="toggle-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="#0F2A4A" stroke-width="2"
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

            <!-- CONTENT -->
            <section class="dashboard-content">

                <div class="page-header-flex">
                    <div>
                        <h1 class="page-title">Data Pelanggan</h1>
                    </div>

                    <button type="button"
                            class="btn-primary"
                            id="openTambahPelanggan">
                        + Tambah Pelanggan
                    </button>
                </div>

                <!-- NOTIFIKASI -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
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

                    <!-- SEARCH -->
                    <div class="transaksi-search-wrapper">
                        <div class="transaksi-search-box">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="7"
                                        stroke="currentColor"
                                        stroke-width="2"/>
                                <path d="M20 20L16.65 16.65"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"/>
                            </svg>

                            <input type="text"
                                   id="searchPelanggan"
                                   placeholder="Cari nama atau no_hp..."
                                   autocomplete="off">
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="transaksi-table-wrapper">

                        <table class="custom-table transaksi-table"
                               id="tabelPelanggan">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Alamat</th>
                                    <th class="aksi-column">Aksi</th>
                                </tr>
                            </thead>

                            <tbody id="pelangganTableBody">

                                @forelse($pelanggan as $index => $item)
                                    <tr class="pelanggan-row"
                                        data-search="{{ strtolower($item->nama . ' ' . $item->no_hp) }}">

                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>{{ $item->nama }}</strong>
                                        </td>

                                        <td>{{ $item->no_hp }}</td>

                                        <td>{{ $item->alamat }}</td>

                                        <td class="aksi-column">
                                            <div class="transaksi-action-buttons">

                                                <!-- TOMBOL EDIT -->
                                                <button type="button"
                                                        class="transaksi-action-btn transaksi-action-edit btn-edit-pelanggan"
                                                        data-id="{{ $item->id_pelanggan }}"
                                                        data-nama="{{ $item->nama }}"
                                                        data-no-hp="{{ $item->no_hp }}"
                                                        data-alamat="{{ $item->alamat }}"
                                                        title="Edit">

                                                    <svg viewBox="0 0 24 24" fill="none">
                                                        <path d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"
                                                              stroke-linejoin="round"/>

                                                        <path d="M18.4 2.6a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4z"
                                                              stroke="currentColor"
                                                              stroke-width="2"
                                                              stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </button>

                                                <!-- TOMBOL HAPUS: TIDAK DIBUNGKUS FORM LAMA -->
                                                <button type="button"
                                                        class="transaksi-action-btn transaksi-action-delete btn-hapus-pelanggan"
                                                        data-id="{{ $item->id_pelanggan }}"
                                                        data-nama="{{ $item->nama }}"
                                                        data-url="{{ route('pelanggan.destroy', $item->id_pelanggan) }}"
                                                        title="Hapus">

                                                    <svg viewBox="0 0 24 24" fill="none">
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
                                    <tr id="emptyPelangganRow">
                                        <td colspan="5"
                                            class="text-center transaksi-empty">
                                            Belum ada data pelanggan.
                                        </td>
                                    </tr>
                                @endforelse

                                <tr id="searchEmptyRow" style="display: none;">
                                    <td colspan="5"
                                        class="text-center transaksi-empty">
                                        Data pelanggan tidak ditemukan.
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- FOOTER -->
                    <div class="transaksi-pagination-footer">

                        <div class="transaksi-pagination-info"
                             id="pelangganTableInfo">

                            Menampilkan

                            <strong>
                                {{ $pelanggan->count() > 0 ? '1 - ' . $pelanggan->count() : '0' }}
                            </strong>

                            dari

                            <strong>{{ $pelanggan->count() }}</strong>

                            data
                        </div>

                        <div class="transaksi-pagination">

                            <button type="button"
                                    class="pagination-btn pagination-arrow"
                                    id="prevPelanggan"
                                    disabled>
                                ‹
                            </button>

                            <button type="button"
                                    class="pagination-btn active">
                                1
                            </button>

                            <button type="button"
                                    class="pagination-btn pagination-arrow"
                                    id="nextPelanggan"
                                    disabled>
                                ›
                            </button>

                        </div>
                    </div>

                </div>
            </section>
        </main>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal-overlay" id="modalTambahPelanggan">

        <div class="modal-card" role="dialog" aria-modal="true">

            <div class="modal-header">
                <div>
                    <h2>Tambah Pelanggan</h2>
                </div>

                <button type="button"
                        class="modal-close"
                        id="closeTambahPelanggan">
                    &times;
                </button>
            </div>

            <form action="{{ route('pelanggan.store') }}"
                  method="POST"
                  class="pelanggan-form">

                @csrf

                <div class="modal-form-group">
                    <label for="modal_nama">Nama Pelanggan</label>

                    <input type="text"
                           id="modal_nama"
                           name="nama"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama pelanggan"
                           required>

                    @error('nama')
                        <small class="modal-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="modal-form-group">
                    <label for="modal_no_hp">No. HP</label>

                    <input type="text"
                           id="modal_no_hp"
                           name="no_hp"
                           value="{{ old('no_hp') }}"
                           placeholder="Masukkan nomor HP pelanggan"
                           required>

                    @error('no_hp')
                        <small class="modal-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="modal-form-group">
                    <label for="modal_alamat">Alamat</label>

                    <textarea id="modal_alamat"
                              name="alamat"
                              rows="4"
                              placeholder="Masukkan alamat pelanggan"
                              required>{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <small class="modal-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            id="cancelTambahPelanggan">
                        Batal
                    </button>

                    <button type="submit"
                            class="modal-btn modal-btn-save">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal-overlay" id="modalEditPelanggan">

        <div class="modal-card" role="dialog" aria-modal="true">

            <div class="modal-header">
                <div>
                    <h2>Edit Pelanggan</h2>
                    <p>Perbarui data pelanggan</p>
                </div>

                <button type="button"
                        class="modal-close"
                        id="closeEditPelanggan">
                    &times;
                </button>
            </div>

            <form action=""
                  method="POST"
                  class="pelanggan-form"
                  id="formEditPelanggan">

                @csrf
                @method('PUT')

                <div class="modal-form-group">
                    <label for="edit_nama">Nama Pelanggan</label>

                    <input type="text"
                           id="edit_nama"
                           name="nama"
                           placeholder="Masukkan nama pelanggan"
                           required>
                </div>

                <div class="modal-form-group">
                    <label for="edit_no_hp">No. HP</label>

                    <input type="text"
                           id="edit_no_hp"
                           name="no_hp"
                           placeholder="Masukkan nomor HP pelanggan"
                           required>
                </div>

                <div class="modal-form-group">
                    <label for="edit_alamat">Alamat</label>

                    <textarea id="edit_alamat"
                              name="alamat"
                              rows="4"
                              placeholder="Masukkan alamat pelanggan"
                              required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            id="cancelEditPelanggan">
                        Batal
                    </button>

                    <button type="submit"
                            class="modal-btn modal-btn-save">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL HAPUS -->
    <div class="modal-overlay" id="modalHapus">

        <div class="modal-card" role="dialog" aria-modal="true">

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

            <h2>Konfirmasi Hapus</h2>

            <p>
                Apakah kamu yakin ingin menghapus pelanggan
                <strong id="namaPelangganHapus"></strong>?
            </p>

            <form id="formHapusPelanggan" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-footer">

                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            id="batalHapusPelanggan">
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

    <!-- JAVASCRIPT PELANGGAN -->
    <script src="{{ asset('js/pelanggan.js') }}"></script>

</body>
</html>
