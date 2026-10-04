<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Data Pelanggan - Kay Laundry</title>

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
                    class="sidebar-link active"
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
                    class="sidebar-link"
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
                            Data Pelanggan
                        </h1>

                        <p class="page-subtitle">
                            Kelola data pelanggan Kay Laundry
                        </p>

                    </div>


                    <!-- BUTTON TAMBAH -->

                    <button
                        type="button"
                        class="btn-primary"
                        id="openTambahPelanggan"
                    >
                        + Tambah Pelanggan
                    </button>

                </div>



                <!-- PESAN BERHASIL -->

                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif



                <!-- PESAN ERROR -->

                @if(session('error'))

                    <div class="alert alert-error">

                        {{ session('error') }}

                    </div>

                @endif



                <!-- =================================================
                     TABEL PELANGGAN
                ================================================== -->

                <div class="table-card">

                    <table class="custom-table">

                        <thead>

                            <tr>

                                <th style="width: 60px;">
                                    No
                                </th>

                                <th>
                                    Nama Pelanggan
                                </th>

                                <th>
                                    No. HP
                                </th>

                                <th>
                                    Alamat
                                </th>

                                <th
                                    style="
                                        width: 160px;
                                        text-align: center;
                                    "
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($pelanggan as $index => $item)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>


                                    <td>

                                        <strong>
                                            {{ $item->nama }}
                                        </strong>

                                    </td>


                                    <td>
                                        {{ $item->no_hp }}
                                    </td>


                                    <td>
                                        {{ $item->alamat }}
                                    </td>


                                    <td>

                                        <div class="action-btn-group">


                                            <!-- BUTTON EDIT -->

                                            <button
                                                type="button"
                                                class="btn-action btn-edit btn-edit-pelanggan"
                                                data-id="{{ $item->id_pelanggan }}"
                                                data-nama="{{ $item->nama }}"
                                                data-no-hp="{{ $item->no_hp }}"
                                                data-alamat="{{ $item->alamat }}"
                                            >
                                                Edit
                                            </button>


                                            <!-- BUTTON HAPUS -->

                                            <form
                                                action="{{ route('pelanggan.destroy', $item->id_pelanggan) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn-action btn-delete"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty-state"
                                    >

                                        <p>
                                            Belum ada data pelanggan.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </main>

    </div>



    <!-- =====================================================
         MODAL TAMBAH PELANGGAN
    ====================================================== -->

    <div
        class="modal-overlay"
        id="modalTambahPelanggan"
    >

        <div
            class="modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modalTitle"
        >

            <div class="modal-header">

                <div>

                    <h2 id="modalTitle">
                        Tambah Pelanggan
                    </h2>

                    <p>
                        Tambahkan data pelanggan baru
                    </p>

                </div>


                <button
                    type="button"
                    class="modal-close"
                    id="closeTambahPelanggan"
                    aria-label="Tutup modal"
                >
                    &times;
                </button>

            </div>



            <!-- FORM TAMBAH -->

            <form
                action="{{ route('pelanggan.store') }}"
                method="POST"
                class="pelanggan-form"
            >

                @csrf


                <!-- NAMA -->

                <div class="modal-form-group">

                    <label for="modal_nama">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        id="modal_nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama pelanggan"
                        required
                    >

                    @error('nama')

                        <small class="modal-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>



                <!-- NO HP -->

                <div class="modal-form-group">

                    <label for="modal_no_hp">
                        No. HP
                    </label>

                    <input
                        type="text"
                        id="modal_no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Masukkan nomor HP pelanggan"
                        required
                    >

                    @error('no_hp')

                        <small class="modal-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>



                <!-- ALAMAT -->

                <div class="modal-form-group">

                    <label for="modal_alamat">
                        Alamat
                    </label>

                    <textarea
                        id="modal_alamat"
                        name="alamat"
                        rows="4"
                        placeholder="Masukkan alamat pelanggan"
                        required
                    >{{ old('alamat') }}</textarea>

                    @error('alamat')

                        <small class="modal-error">
                            {{ $message }}
                        </small>

                    @enderror

                </div>



                <!-- BUTTON -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="modal-btn modal-btn-cancel"
                        id="cancelTambahPelanggan"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="modal-btn modal-btn-save"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>



    <!-- =====================================================
         MODAL EDIT PELANGGAN
    ====================================================== -->

    <div
        class="modal-overlay"
        id="modalEditPelanggan"
    >

        <div
            class="modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modalEditTitle"
        >

            <div class="modal-header">

                <div>

                    <h2 id="modalEditTitle">
                        Edit Pelanggan
                    </h2>

                    <p>
                        Perbarui data pelanggan
                    </p>

                </div>


                <button
                    type="button"
                    class="modal-close"
                    id="closeEditPelanggan"
                    aria-label="Tutup modal"
                >
                    &times;
                </button>

            </div>



            <!-- FORM EDIT -->

            <form
                action=""
                method="POST"
                class="pelanggan-form"
                id="formEditPelanggan"
            >

                @csrf

                @method('PUT')


                <!-- NAMA -->

                <div class="modal-form-group">

                    <label for="edit_nama">
                        Nama Pelanggan
                    </label>

                    <input
                        type="text"
                        id="edit_nama"
                        name="nama"
                        placeholder="Masukkan nama pelanggan"
                        required
                    >

                </div>



                <!-- NO HP -->

                <div class="modal-form-group">

                    <label for="edit_no_hp">
                        No. HP
                    </label>

                    <input
                        type="text"
                        id="edit_no_hp"
                        name="no_hp"
                        placeholder="Masukkan nomor HP pelanggan"
                        required
                    >

                </div>



                <!-- ALAMAT -->

                <div class="modal-form-group">

                    <label for="edit_alamat">
                        Alamat
                    </label>

                    <textarea
                        id="edit_alamat"
                        name="alamat"
                        rows="4"
                        placeholder="Masukkan alamat pelanggan"
                        required
                    ></textarea>

                </div>



                <!-- BUTTON -->

                <div class="modal-footer">

                    <button
                        type="button"
                        class="modal-btn modal-btn-cancel"
                        id="cancelEditPelanggan"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="modal-btn modal-btn-save"
                    >
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>



    <!-- =====================================================
         JAVASCRIPT EXTERNAL
    ====================================================== -->

    <script src="{{ asset('js/pelanggan.js') }}"></script>

</body>

</html>