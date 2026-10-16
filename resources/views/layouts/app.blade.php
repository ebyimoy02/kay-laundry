
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kay Laundry - @yield('title', 'Dashboard')</title>

    <!-- Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS dan FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS utama -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard-figma.css') }}">

    <!-- Perbaikan sidebar dan profil -->
    <style>
        /* HAMBURGER */
        .toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            cursor: pointer;
            border: none;
            outline: none;
            background: transparent;
            padding: 10px;
            border-radius: 8px;
        }

        .toggle-btn:hover {
            background-color: #f1f5f9;
        }

        .toggle-btn svg {
            display: block;
            pointer-events: none;
        }

        /* TRANSISI SIDEBAR */
        .dashboard-wrapper > #sidebarMenu {
            box-sizing: border-box;
            overflow: hidden;
            transition:
                width 0.3s ease,
                min-width 0.3s ease,
                flex-basis 0.3s ease,
                padding 0.3s ease,
                border-width 0.3s ease;
        }

        /* SIDEBAR DITUTUP */
        .dashboard-wrapper.sidebar-collapsed > #sidebarMenu {
            display: flex !important;
            width: 0 !important;
            min-width: 0 !important;
            flex: 0 0 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            border-left-width: 0 !important;
            border-right-width: 0 !important;
            overflow: hidden !important;
        }

        .dashboard-wrapper.sidebar-collapsed > #sidebarMenu > * {
            visibility: hidden;
            pointer-events: none;
        }

        /* KONTEN MELEBAR SAAT SIDEBAR DITUTUP */
        .dashboard-wrapper > .main-content {
            flex: 1 1 0%;
            min-width: 0;
        }

        .dashboard-wrapper.sidebar-collapsed > .main-content {
            width: 100% !important;
            min-width: 0 !important;
            flex: 1 1 0% !important;
        }

        /* PROFIL OPERATOR */
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-profile::before,
        .admin-profile::after,
        .admin-info::before,
        .admin-info::after {
            content: none !important;
            display: none !important;
        }

        /* Sembunyikan tombol atau ikon panah dekoratif */
        .admin-profile button,
        .admin-profile [class*="chevron"],
        .admin-profile [class*="arrow"],
        .admin-info button,
        .admin-info [class*="chevron"],
        .admin-info [class*="arrow"] {
            display: none !important;
        }

        /* Sembunyikan SVG panah yang berada tepat setelah informasi profil */
        .admin-info + svg {
            display: none !important;
        }
    </style>

    @stack('styles')
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

            <!-- MENU SIDEBAR -->
            <nav class="sidebar-menu">

                <!-- DASHBOARD -->
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 3 2 12h3v8h5v-5h4v5h5v-8h3z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- PELANGGAN -->
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

                <!-- PAKET LAUNDRY -->
                <a href="{{ route('paket.index') }}"
                   class="sidebar-link {{ request()->routeIs('paket.*') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7 2h2v2h6V2h2v2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2zM5 9v11h14V9z"/>
                        <rect x="7" y="12" width="4" height="3"/>
                    </svg>
                    <span>Paket Laundry</span>
                </a>

                <!-- TRANSAKSI -->
                <a href="{{ route('transaksi.index') }}"
                   class="sidebar-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                    <svg class="menu-svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm2 5v2h10V8zm0 4v2h10v-2zm0 4v2h6v-2z"/>
                    </svg>
                    <span>Transaksi</span>
                </a>

                <!-- LAPORAN -->
                <a href="{{ \Illuminate\Support\Facades\Route::has('laporan.index') ? route('laporan.index') : route('laporan') }}"
                   class="sidebar-link {{ request()->routeIs('laporan', 'laporan.*') ? 'active' : '' }}">
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

        <!-- KONTEN UTAMA -->
        <main class="main-content">

            <!-- TOPBAR -->
            <header class="dashboard-topbar">

                <!-- HAMBURGER MENU -->
                <button
                    type="button"
                    class="toggle-btn"
                    id="sidebarToggle"
                    aria-label="Tutup sidebar"
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

                <!-- PROFIL -->
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
                @yield('content')
            </section>

        </main>
    </div>

    <!-- JAVASCRIPT SIDEBAR -->
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>

    @stack('scripts')

</body>
</html>
