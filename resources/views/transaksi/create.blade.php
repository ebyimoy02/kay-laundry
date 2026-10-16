<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Transaksi - Kay Laundry</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

</head>


<body class="dashboard-page">


    <div class="dashboard-wrapper">


        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <aside class="sidebar">


            <div class="sidebar-brand">

                <div class="brand-icon">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#ffffff"
                        stroke-width="2"
                    >

                        <rect
                            x="3"
                            y="3"
                            width="18"
                            height="18"
                            rx="3"
                        />

                        <circle
                            cx="12"
                            cy="13"
                            r="4"
                        />

                        <circle
                            cx="7"
                            cy="7"
                            r="1"
                            fill="#ffffff"
                        />

                        <circle
                            cx="10"
                            cy="7"
                            r="1"
                            fill="#ffffff"
                        />

                    </svg>

                </div>

                <h2>Laundry</h2>

            </div>


            <nav class="sidebar-menu">


                <!-- DASHBOARD -->

                <a
                    href="{{ route('dashboard') }}"
                    class="sidebar-link"
                >

                    <svg
                        class="menu-svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>

                        <polyline points="9 22 9 12 15 12 15 22"/>

                    </svg>

                    <span>Dashboard</span>

                </a>


                <!-- PELANGGAN -->

                <a
                    href="{{ route('pelanggan.index') }}"
                    class="sidebar-link"
                >

                    <svg
                        class="menu-svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>

                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                    </svg>

                    <span>Pelanggan</span>

                </a>


                <!-- PAKET LAUNDRY -->

                <a
                    href="{{ route('paket.index') }}"
                    class="sidebar-link"
                >

                    <svg
                        class="menu-svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>

                        <polyline points="3.29 7 12 12 20.71 7"/>

                        <line
                            x1="12"
                            y1="22"
                            x2="12"
                            y2="12"
                        />

                    </svg>

                    <span>Paket Laundry</span>

                </a>


                <!-- TRANSAKSI -->

                <a
                    href="{{ route('transaksi.index') }}"
                    class="sidebar-link active"
                >

                    <svg
                        class="menu-svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="16"
                            rx="2"
                        />

                        <line
                            x1="7"
                            y1="8"
                            x2="17"
                            y2="8"
                        />

                        <line
                            x1="7"
                            y1="12"
                            x2="13"
                            y2="12"
                        />

                    </svg>

                    <span>Transaksi</span>

                </a>


                <!-- LAPORAN -->

                <a
                    href="{{ route('laporan') }}"
                    class="sidebar-link"
                >

                    <svg
                        class="menu-svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                        <polyline points="14 2 14 8 20 8"/>

                        <line
                            x1="16"
                            y1="13"
                            x2="8"
                            y2="13"
                        />

                        <line
                            x1="16"
                            y1="17"
                            x2="8"
                            y2="17"
                        />

                    </svg>

                    <span>Laporan</span>

                </a>


                <!-- LOGOUT -->

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                >

                    @csrf

                    <button
                        type="submit"
                        class="sidebar-link"
                    >

                        <svg
                            class="menu-svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>

                            <polyline points="16 17 21 12 16 7"/>

                            <line
                                x1="21"
                                y1="12"
                                x2="9"
                                y2="12"
                            />

                        </svg>

                        <span>Logout</span>

                    </button>

                </form>

            </nav>

        </aside>



        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

        <main class="main-content">


            <!-- TOPBAR -->

            <header class="dashboard-topbar">

                <button
                    type="button"
                    class="toggle-btn"
                >

                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#0F2A4A"
                        stroke-width="2"
                    >

                        <line
                            x1="3"
                            y1="12"
                            x2="21"
                            y2="12"
                        />

                        <line
                            x1="3"
                            y1="6"
                            x2="21"
                            y2="6"
                        />

                        <line
                            x1="3"
                            y1="18"
                            x2="21"
                            y2="18"
                        />

                    </svg>

                </button>


                <div class="admin-profile">

                    <div class="admin-avatar">

                        <svg
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#0F2A4A"
                            stroke-width="2"
                        >

                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>

                            <circle
                                cx="12"
                                cy="7"
                                r="4"
                            />

                        </svg>

                    </div>


                    <div class="admin-info">

                        <strong>Operator</strong>

                        <span>Operator</span>

                    </div>


                    <svg
                        width="14"
                        height="14"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="#7b8794"
                        stroke-width="2"
                    >

                        <polyline points="6 9 12 15 18 9"/>

                    </svg>

                </div>

            </header>



            <!-- =====================================================
                 CONTENT
            ====================================================== -->

            <section class="dashboard-content">


                <!-- PAGE HEADER -->

                <div class="page-header-flex">

                    <div>

                        <h1 class="page-title">
                            Tambah Transaksi
                        </h1>

                        <p class="page-subtitle">
                            Tambahkan transaksi laundry baru
                        </p>

                    </div>

                </div>



                <!-- =================================================
                     FORM TRANSAKSI
                ================================================== -->

                <div class="table-card">


                    <form
                        action="{{ route('transaksi.store') }}"
                        method="POST"
                        id="formTransaksi"
                    >

                        @csrf


                        <!-- =========================================
                             DATA TRANSAKSI
                        ========================================== -->

                        <div class="transaksi-form-section">


                            <div class="transaksi-form-group">

                                <label for="id_pelanggan">
                                    Pelanggan
                                </label>

                                <select
                                    id="id_pelanggan"
                                    name="id_pelanggan"
                                    required
                                >

                                    <option value="">
                                        Pilih pelanggan
                                    </option>

                                    @foreach($pelanggan as $item)

                                        <option
                                            value="{{ $item->id_pelanggan }}"
                                            {{ old('id_pelanggan') == $item->id_pelanggan ? 'selected' : '' }}
                                        >
                                            {{ $item->nama }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('id_pelanggan')

                                    <small class="modal-error">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>



                            <div class="transaksi-date-group">


                                <div class="transaksi-form-group">

                                    <label for="tgl_masuk">
                                        Tanggal Masuk
                                    </label>

                                    <input
                                        type="date"
                                        id="tgl_masuk"
                                        name="tgl_masuk"
                                        value="{{ old('tgl_masuk', date('Y-m-d')) }}"
                                        required
                                    >

                                    @error('tgl_masuk')

                                        <small class="modal-error">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>


                                <div class="transaksi-form-group">

                                    <label for="tgl_selesai">
                                        Tanggal Selesai
                                    </label>

                                    <input
                                        type="date"
                                        id="tgl_selesai"
                                        name="tgl_selesai"
                                        value="{{ old('tgl_selesai') }}"
                                    >

                                    @error('tgl_selesai')

                                        <small class="modal-error">
                                            {{ $message }}
                                        </small>

                                    @enderror

                                </div>


                            </div>

                        </div>



                        <!-- =========================================
                             DAFTAR PAKET
                        ========================================== -->

                        <div class="transaksi-package-section">


                            <div class="transaksi-section-header">

                                <div>

                                    <h2>
                                        Paket Laundry
                                    </h2>

                                    <p>
                                        Tambahkan satu atau beberapa paket
                                        dalam transaksi ini.
                                    </p>

                                </div>


                                <button
                                    type="button"
                                    class="btn-primary"
                                    id="btnTambahPaket"
                                >
                                    + Tambah Paket
                                </button>

                            </div>



                            <!-- =====================================
                                 CONTAINER DETAIL PAKET
                            ====================================== -->

                            <div
                                id="detailPaketContainer"
                                class="detail-paket-container"
                            >


                                <!-- BARIS PAKET PERTAMA -->

                                <div
                                    class="detail-paket-row"
                                    data-row="0"
                                >


                                    <div class="transaksi-form-group">

                                        <label>
                                            Paket Laundry
                                        </label>

                                        <select
                                            name="items[0][id_paket]"
                                            class="paket-select"
                                            required
                                        >

                                            <option value="">
                                                Pilih paket
                                            </option>

                                            @foreach($paket as $item)

                                                <option
                                                    value="{{ $item->id_paket }}"
                                                    data-harga="{{ $item->harga }}"
                                                >
                                                    {{ $item->nama_paket }}
                                                    —
                                                    Rp
                                                    {{ number_format(
                                                        $item->harga,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }}
                                                    / {{ $item->satuan }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>



                                    <div class="transaksi-form-group">

                                        <label>
                                            Berat
                                        </label>

                                        <input
                                            type="number"
                                            name="items[0][berat]"
                                            class="paket-berat"
                                            placeholder="Contoh: 3"
                                            min="0.01"
                                            step="0.01"
                                            required
                                        >

                                    </div>



                                    <div class="transaksi-form-group">

                                        <label>
                                            Subtotal
                                        </label>

                                        <input
                                            type="text"
                                            class="paket-subtotal"
                                            value="Rp 0"
                                            readonly
                                        >

                                    </div>



                                    <div class="transaksi-form-action">

                                        <button
                                            type="button"
                                            class="btn-action btn-delete btn-hapus-paket"
                                            disabled
                                        >
                                            Hapus
                                        </button>

                                    </div>


                                </div>


                            </div>


                        </div>



                        <!-- =========================================
                             TOTAL
                        ========================================== -->

                        <div class="transaksi-total-section">

                            <div>

                                <span class="transaksi-total-label">
                                    Total Transaksi
                                </span>

                                <strong
                                    id="totalTransaksi"
                                    class="transaksi-total-value"
                                >
                                    Rp 0
                                </strong>

                            </div>

                        </div>



                        <!-- =========================================
                             BUTTON FORM
                        ========================================== -->

                        <div class="transaksi-form-footer">

                            <a
                                href="{{ route('transaksi.index') }}"
                                class="modal-btn modal-btn-cancel"
                            >
                                Batal
                            </a>


                            <button
                                type="submit"
                                class="modal-btn modal-btn-save"
                            >
                                Simpan Transaksi
                            </button>

                        </div>


                    </form>

                </div>


            </section>

        </main>

    </div>


</body>

</html>