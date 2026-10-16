@php
    // Dummy data hanya tampil jika tabel kosong (sesuai kode awal)
    $dummy = [
        ['Reguler', 15000, 'Kg'],
        ['Express', 25000, 'Kg'],
        ['Kiloan', 35000, 'Kg'],
        ['Cuci Setrika', 20000, 'Kg'],
    ];

    $isPaginator = $paket instanceof \Illuminate\Pagination\LengthAwarePaginator;
    $isEmpty     = $paket->count() === 0;
    $offset      = $isPaginator ? ($paket->firstItem() ?? 1) - 1 : 0;
    $total       = $isEmpty ? count($dummy) : ($isPaginator ? $paket->total() : $paket->count());
    $from        = $total ? ($isEmpty ? 1 : ($isPaginator ? $paket->firstItem() : 1)) : 0;
    $to          = $isEmpty ? count($dummy) : ($isPaginator ? $paket->lastItem() : $paket->count());

    // Sesuaikan dengan route Anda
    $baseUrl = url('paket');
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Paket Laundry - Kay Laundry</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- Urutan WAJIB: sama dengan halaman Pelanggan, lalu paket-figma.css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paket-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-dropdown.css') }}">
</head>

<body class="dashboard-page">

    <div class="dashboard-wrapper">

        {{-- ================= SIDEBAR (sama dengan halaman Pelanggan) ================= --}}
        
        <aside class="sidebar" id="sidebarMenu">

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


                <!-- PELANGGAN -->
                <a href="{{ route('pelanggan.index') }}" class="sidebar-link">

                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="9" cy="8" r="3.5"/>
                        <path d="M2 20c0-3.6 3.1-6 7-6s7 2.4 7 6z"/>
                        <circle cx="17.5" cy="8.5" r="2.7"/>
                        <path d="M17.5 14c2.8 0 5 1.8 5 4.5V20H18v-1.5c0-1.8-.6-3.3-1.7-4.4.4-.1.8-.1 1.2-.1z"/>
                    </svg>

                    <span>Pelanggan</span>

                </a>


                <!-- PAKET LAUNDRY (AKTIF) -->
                <a href="{{ route('paket.index') }}" class="sidebar-link active">

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


        {{-- ================= MAIN ================= --}}
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                {{-- Hamburger: digerakkan oleh js/sidebar-toggle.js --}}

                <button type="button" id="sidebarToggle" class="toggle-btn" aria-label="Buka/tutup menu" aria-expanded="true">

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

                        <h1 class="page-title">
                            Data Paket Laundry
                        </h1>

                    </div>

                    <button type="button"
                            class="btn-primary"
                            id="btnTambah">

                        + Tambah Paket

                    </button>

                </div>


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

                                <circle cx="11"
                                        cy="11"
                                        r="7"
                                        stroke="currentColor"
                                        stroke-width="2"/>

                                <path d="M20 20L16.65 16.65"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"/>

                            </svg>

                            <input type="text"
                                   id="searchPaket"
                                   placeholder="Cari nama paket..."
                                   autocomplete="off">

                        </div>

                    </div>


                    <!-- TABLE -->
                    <div class="transaksi-table-wrapper">

                        <table class="custom-table transaksi-table"
                               id="tabelPaket">

                            <thead>

                                <tr>

                                    <th>No</th>

                                    <th>Nama Paket</th>

                                    <th>Harga</th>

                                    <th>Satuan</th>

                                    <th class="aksi-column">Aksi</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($paket as $index => $item)

                                    <tr>

                                        <td>{{ $offset + $index + 1 }}</td>

                                        <td class="nama-paket">{{ $item->nama_paket }}</td>

                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                                        <td>{{ $item->satuan }}</td>

                                        <td class="aksi-column">

                                            <div class="transaksi-action-buttons">

                                                <button type="button"
                                                        class="btn-edit transaksi-action-btn transaksi-action-edit"
                                                        title="Edit"
                                                        data-id="{{ $item->id_paket }}"
                                                        data-nama="{{ $item->nama_paket }}"
                                                        data-harga="{{ $item->harga }}"
                                                        data-satuan="{{ $item->satuan }}">

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

                                                <button type="button"
                                                        class="btn-hapus transaksi-action-btn transaksi-action-delete"
                                                        title="Hapus"
                                                        data-id="{{ $item->id_paket }}"
                                                        data-nama="{{ $item->nama_paket }}">

                                                    <svg viewBox="0 0 24 24" fill="none">

                                                        <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M6 7L7 20H17L18 7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                                        <path d="M9 7V4H15V7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>

                                                    </svg>

                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    @foreach($dummy as $i => $d)

                                        <tr>

                                            <td>{{ $i + 1 }}</td>

                                            <td class="nama-paket">{{ $d[0] }}</td>

                                            <td>Rp {{ number_format($d[1], 0, ',', '.') }}</td>

                                            <td>{{ $d[2] }}</td>

                                            <td class="aksi-column">

                                                <div class="transaksi-action-buttons">

                                                    <button type="button"
                                                            class="transaksi-action-btn transaksi-action-edit"
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

                                                    <button type="button"
                                                            class="transaksi-action-btn transaksi-action-delete"
                                                            title="Hapus">

                                                        <svg viewBox="0 0 24 24" fill="none">

                                                            <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                            <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                            <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                            <path d="M6 7L7 20H17L18 7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                                            <path d="M9 7V4H15V7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>

                                                        </svg>

                                                    </button>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforeach

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    <!-- FOOTER: INFO + PAGINATION -->
                    <div class="transaksi-pagination-footer">

                        <div class="transaksi-pagination-info">
                            Menampilkan {{ $from }} - {{ $to }} dari {{ $total }} data
                        </div>


                        <div class="transaksi-pagination">

                            @if($isPaginator && $paket->previousPageUrl())
                                <a href="{{ $paket->previousPageUrl() }}" class="pagination-btn pagination-arrow" aria-label="Sebelumnya">&lsaquo;</a>
                            @else
                                <span class="pagination-btn pagination-arrow is-disabled" aria-disabled="true">&lsaquo;</span>
                            @endif

                            <span class="pagination-btn active">
                                {{ $isPaginator ? $paket->currentPage() : 1 }}
                            </span>

                            @if($isPaginator && $paket->nextPageUrl())
                                <a href="{{ $paket->nextPageUrl() }}" class="pagination-btn pagination-arrow" aria-label="Berikutnya">&rsaquo;</a>
                            @else
                                <span class="pagination-btn pagination-arrow is-disabled" aria-disabled="true">&rsaquo;</span>
                            @endif

                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>


    {{-- ================= MODAL TAMBAH / EDIT PAKET ================= --}}
    <div class="modal-overlay" id="modalPaket">

        <div class="modal-card"
             role="dialog"
             aria-modal="true"
             aria-labelledby="modalPaketTitle">

            <div class="modal-header">

                <h2 id="modalPaketTitle">Tambah Paket Laundry</h2>

                <button type="button"
                        class="modal-close"
                        data-close-modal
                        aria-label="Tutup">

                    &times;

                </button>

            </div>


            <form id="formPaket"
                  method="POST"
                  action="{{ $baseUrl }}"
                  class="pelanggan-form">

                @csrf

                <input type="hidden" name="_method" id="formPaketMethod" value="POST">

                <div class="modal-form-group">

                    <label for="nama_paket">Nama Paket</label>

                    <input type="text"
                           name="nama_paket"
                           id="nama_paket"
                           placeholder="Masukkan nama paket"
                           required>

                </div>


                <div class="modal-form-group">

                    <label for="harga">Harga</label>

                    <input type="number"
                           name="harga"
                           id="harga"
                           min="0"
                           placeholder="Masukkan harga"
                           required>

                </div>


                <div class="modal-form-group">

                    <label for="satuan">Satuan</label>

                    <select name="satuan" id="satuan" required>

                        <option value="" disabled selected hidden>Pilih satuan</option>
                        <option value="Kg">Kg</option>
                        <option value="Pcs">Pcs</option>
                        <option value="m2">m²</option>

                    </select>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            data-close-modal>

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


    {{-- ================= MODAL KONFIRMASI HAPUS ================= --}}
    <div class="modal-overlay" id="modalHapus">

        <div class="modal-card"
             role="dialog"
             aria-modal="true"
             aria-labelledby="hapusTitle">

            <div class="hapus-icon">

                <svg viewBox="0 0 24 24" fill="none">

                    <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M6 7L7 20H17L18 7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M9 7V4H15V7" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>

                </svg>

            </div>

            <h2 id="hapusTitle">Hapus Paket?</h2>

            <p>Paket <strong id="hapusNama"></strong> akan dihapus permanen.</p>

            <form id="formHapus" method="POST" action="">

                @csrf
                @method('DELETE')

                <div class="modal-footer">

                    <button type="button"
                            class="modal-btn modal-btn-cancel"
                            data-close-modal>

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


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const baseUrl    = @json($baseUrl);
        const modalPaket = document.getElementById('modalPaket');
        const modalHapus = document.getElementById('modalHapus');
        const formPaket  = document.getElementById('formPaket');
        const methodInp  = document.getElementById('formPaketMethod');

        const open  = m => m.classList.add('active');
        const close = m => m.classList.remove('active');

        // Tambah
        document.getElementById('btnTambah').addEventListener('click', () => {
            formPaket.reset();
            formPaket.action = baseUrl;
            methodInp.value = 'POST';
            document.getElementById('modalPaketTitle').textContent = 'Tambah Paket Laundry';
            open(modalPaket);
            document.getElementById('nama_paket').focus();
        });

        
        // Edit
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;

                if (!id) {
                    return;
                }

                formPaket.reset();
                formPaket.action = `${baseUrl}/${id}`;
                methodInp.value = 'PUT';

                document.getElementById('nama_paket').value = btn.dataset.nama;
                document.getElementById('harga').value = btn.dataset.harga;
                document.getElementById('satuan').value = btn.dataset.satuan;

                document.getElementById('modalPaketTitle').textContent = 'Edit Paket Laundry';
                open(modalPaket);
            });
        });

        // Hapus
        document.querySelectorAll('.btn-hapus').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;

                if (!id) {
                    return;
                }

                document.getElementById('formHapus').action = `${baseUrl}/${id}`;
                document.getElementById('hapusNama').textContent = btn.dataset.nama || 'paket ini';

                open(modalHapus);
            });
        });


        // Tutup modal (tombol Batal/×, klik area gelap, tombol Esc)
        document.querySelectorAll('[data-close-modal]').forEach(b =>
            b.addEventListener('click', () => { close(modalPaket); close(modalHapus); }));
        [modalPaket, modalHapus].forEach(m =>
            m.addEventListener('click', e => { if (e.target === m) close(m); }));
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { close(modalPaket); close(modalHapus); }
        });

        // Pencarian di sisi klien
        document.getElementById('searchPaket').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#tabelPaket tbody tr').forEach(tr => {
                const nama = tr.querySelector('.nama-paket')?.textContent.toLowerCase() ?? '';
                tr.style.display = nama.includes(q) ? '' : 'none';
            });
        });
    });
    </script>

    {{-- Membuat tombol hamburger berfungsi --}}
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>

</body>

</html>