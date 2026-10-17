<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Transaksi - Kay Laundry</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaksi-figma.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-dropdown.css') }}">
</head>

<body class="dashboard-page">

    <div class="dashboard-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebarMenu">

            <!-- LOGO LAUNDRY -->
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

            <!-- MENU SIDEBAR -->
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

                <!-- PAKET LAUNDRY -->
                <a href="{{ route('paket.index') }}" class="sidebar-link">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7 2h2v2h6V2h2v2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2zM5 9v11h14V9z"/>
                        <rect x="7" y="12" width="4" height="3"/>
                    </svg>
                    <span>Paket Laundry</span>
                </a>

                <!-- TRANSAKSI: AKTIF -->
                <a href="{{ route('transaksi.index') }}" class="sidebar-link active">
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

        <!-- KONTEN UTAMA -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                <button
                    class="toggle-btn"
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

                <!-- PROFIL OPERATOR -->
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

            <!-- AREA DETAIL TRANSAKSI -->
            <section class="dashboard-content">

                <div class="page-header-flex">

                    <div>
                        <h1 class="page-title">Detail Transaksi</h1>
                    </div>

                    <!-- TOMBOL EDIT DAN KEMBALI -->
                    <div style="display: flex; gap: 10px; align-items: center;">

                        <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}"
                           class="btn-primary">
                            Edit
                        </a>

                        <a href="{{ route('transaksi.index') }}"
                           class="btn-primary">
                            &larr; Kembali
                        </a>

                    </div>

                </div>

                <!-- INFORMASI DETAIL -->
                <div class="detail-grid">

                    <!-- KARTU INFORMASI UTAMA -->
                    <div class="detail-card detail-main">

                        <h2 class="detail-card-title">
                            Informasi Utama Transaksi
                        </h2>

                        <dl>

                            <div class="info-row">
                                <dt>ID Transaksi</dt>
                                <dd>
                                    TRX{{ str_pad($transaksi->id_transaksi, 3, '0', STR_PAD_LEFT) }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Tanggal</dt>
                                <dd>
                                    {{ $transaksi->tgl_masuk
                                        ? \Carbon\Carbon::parse($transaksi->tgl_masuk)->format('d-m-Y')
                                        : '-' }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Pelanggan</dt>
                                <dd>
                                    {{ $transaksi->pelanggan->nama ?? '-' }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Paket</dt>
                                <dd>
                                    <div class="paket-group">
                                        @forelse ($transaksi->detailTransaksi as $detail)
                                            <div>
                                                <strong>
                                                    {{ $detail->paket->nama_paket ?? 'Paket tidak tersedia' }}
                                                </strong>

                                                <div>
                                                    {{ number_format((float) $detail->berat, 2, ',', '.') }}
                                                    {{ $detail->paket->satuan ?? '' }}
                                                </div>
                                            </div>
                                        @empty
                                            <span>-</span>
                                        @endforelse
                                    </div>
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Total</dt>
                                <dd>
                                    <strong>
                                        Rp {{ number_format((float) $transaksi->total, 0, ',', '.') }}
                                    </strong>
                                </dd>
                            </div>

                        </dl>

                    </div>

                    <!-- KARTU DETAIL PAKET LAUNDRY -->
                    <div class="detail-card">

                        <h2 class="detail-card-title">
                            Detail Paket Laundry
                        </h2>

                        @forelse ($transaksi->detailTransaksi as $detail)

                            <div class="paket-group">

                                <div class="info-row">
                                    <dt>Nama Paket</dt>
                                    <dd>
                                        {{ $detail->paket->nama_paket ?? 'Paket tidak tersedia' }}
                                    </dd>
                                </div>

                                <div class="info-row">
                                    <dt>Harga Paket</dt>
                                    <dd>
                                        Rp {{ number_format((float) $detail->harga, 0, ',', '.') }}
                                    </dd>
                                </div>

                                <div class="info-row">
                                    <dt>Satuan</dt>
                                    <dd>
                                        {{ $detail->paket->satuan ?? '-' }}
                                    </dd>
                                </div>

                                <div class="info-row">
                                    <dt>Berat</dt>
                                    <dd>
                                        {{ number_format((float) $detail->berat, 2, ',', '.') }}
                                        {{ $detail->paket->satuan ?? '' }}
                                    </dd>
                                </div>

                                <div class="info-row">
                                    <dt>Subtotal</dt>
                                    <dd>
                                        Rp {{ number_format((float) $detail->subtotal, 0, ',', '.') }}
                                    </dd>
                                </div>

                            </div>

                        @empty

                            <p>Belum ada detail paket laundry.</p>

                        @endforelse

                    </div>

                    <!-- KARTU DATA PELANGGAN -->
                    <div class="detail-card">

                        <h2 class="detail-card-title">
                            Data Pelanggan
                        </h2>

                        <dl>

                            <div class="info-row">
                                <dt>Nama</dt>
                                <dd>
                                    {{ $transaksi->pelanggan->nama ?? '-' }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>No. HP</dt>
                                <dd>
                                    {{ $transaksi->pelanggan->no_hp ?? '-' }}
                                </dd>
                            </div>

                            <div class="info-row">
                                <dt>Alamat</dt>
                                <dd>
                                    {{ $transaksi->pelanggan->alamat ?? '-' }}
                                </dd>
                            </div>

                        </dl>

                    </div>

                </div>

            </section>

        </main>

    </div>

    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>

</body>
</html>