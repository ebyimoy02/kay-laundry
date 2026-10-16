<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Laundry</title>

    <!-- [UBAH 1] Font Roboto (sesuai tipografi Figma). Fallback tetap Segoe UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* [UBAH 2] Token warna & ukuran di satu tempat, mudah disetel ulang
           kalau nilai asli dari Figma (Dev Mode) berbeda sedikit. */
        :root {
            --navy: #04285c;          /* panel kiri, tombol, judul "Login" */
            --navy-hover: #0a3270;
            --blue-text: #1e4d8f;     /* subjudul "Silakan masuk..." */
            --blue-border: #c6d8f0;   /* border input */
            --input-bg: #f5f9ff;      /* latar input */
            --page-bg: #eaf1fb;       /* latar luar kartu */
            --placeholder: #6b7c93;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* [UBAH 3] Halaman: latar biru muda + kartu di tengah.
           overflow:hidden dihapus supaya tidak terpotong di layar pendek/mobile. */
        html, body {
            width: 100%;
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #ffffff;
        }

        /* [UBAH 4] .login-wrapper fullscreen tanpa latar belakang luar,
           dua kolom 50/50 memenuhi seluruh layar. */
        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            min-height: 100dvh;
            background-color: #ffffff;
        }

        /* SISI KIRI - NAVY */
        .login-left {
            flex: 1;
            background-color: var(--navy);          /* [UBAH 5] navy sesuai Figma */
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .login-left .icon-box {
            margin-bottom: 38px;                    /* [UBAH 6] jarak logo -> judul */
        }

        /* [UBAH 7] Ukuran logo diatur dari CSS (atribut width/height SVG tidak dipakai) */
        .login-left .icon-box svg {
            display: block;
            width: 150px;
            height: auto;
        }

        .login-left h1 {
            font-size: 40px;                        /* [UBAH 8] judul: lebih besar, weight 500 */
            font-weight: 500;
            line-height: 1.2;
            letter-spacing: 0.2px;
            margin-bottom: 22px;
        }

        .login-left p {
            font-size: 17px;                        /* [UBAH 9] tagline putih, weight 400 */
            color: #ffffff;
            font-weight: 400;
            max-width: none;
            line-height: 1.5;
        }

        /* SISI KANAN - FORM */
        .login-right {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 48px;
        }

        .form-container {
            width: 100%;
            max-width: 404px;                       /* [UBAH 10] lebar form sesuai proporsi Figma */
        }

        .login-header {
            text-align: center;
            margin-bottom: 52px;                    /* [UBAH 11] jarak subjudul -> input */
        }

        .login-header h2 {
            font-size: 42px;                        /* [UBAH 12] "Login" lebih besar */
            color: var(--navy);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 14px;
        }

        .login-header p {
            font-size: 16px;
            color: var(--blue-text);                /* [UBAH 13] abu-abu -> biru navy */
        }

        /* INPUT FIELD DENGAN IKON */
        .input-group {
            position: relative;
            margin-bottom: 24px;                    /* [UBAH 14] jarak antar input */
        }

        .input-group .input-icon {
            position: absolute;
            left: 20px;                             /* [UBAH 15] posisi ikon */
            top: 50%;
            transform: translateY(-50%);
            color: var(--navy);                     /* ikon navy solid, bukan abu-abu */
            display: flex;
            align-items: center;
        }

        .input-group .input-icon svg {
            width: 22px;
            height: 22px;
        }

        .input-group input {
            width: 100%;
            height: 58px;                           /* [UBAH 16] tinggi input */
            padding: 0 16px 0 60px;                 /* teks mulai setelah ikon */
            border: 1.5px solid var(--blue-border); /* border biru muda */
            border-radius: 8px;
            background-color: var(--input-bg);      /* latar biru sangat muda */
            font-size: 16px;
            outline: none;
            color: var(--navy);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-group input::placeholder {
            color: var(--placeholder);
        }

        .input-group input:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 4px rgba(4, 40, 92, 0.12);
        }

        .btn-submit {
            width: 100%;
            height: 58px;                           /* [UBAH 17] tinggi tombol = tinggi input */
            background-color: var(--navy);
            color: #ffffff;
            border: none;
            padding: 0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 15px;                       /* total jarak input -> tombol ±39px */
        }

        .btn-submit:hover {
            background-color: var(--navy-hover);
        }

        .btn-submit:focus-visible {
            outline: 3px solid rgba(4, 40, 92, 0.35);
            outline-offset: 2px;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* [UBAH 18] RESPONSIF: tablet/mobile -> kolom ditumpuk, kartu penuh layar */
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }
            .login-left {
                flex: none;
                padding: 36px 20px;
            }
            .login-left .icon-box { margin-bottom: 20px; }
            .login-left .icon-box svg { width: 90px; }
            .login-left h1 { font-size: 28px; margin-bottom: 10px; }
            .login-left p { font-size: 14px; }
            .login-right {
                flex: 1;
                justify-content: flex-start;
                padding: 36px 24px 48px;
            }
            .login-header { margin-bottom: 36px; }
            .login-header h2 { font-size: 34px; }
        }

        @media (max-width: 480px) {
            .login-left h1 { font-size: 24px; }
            .input-group input,
            .btn-submit { height: 52px; }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">

        <!-- KIRI: INFORMASI LAUNDRY -->
        <div class="login-left">
            <div class="icon-box">
                <!-- [UBAH 19] Ikon diganti agar bentuknya sama dengan Figma:
                     mesin cuci tegak + panel atas (2 titik & garis) + pintu bergelombang
                     + 2 gelembung di kanan atas yang terpisah dari badan mesin. -->
                <svg viewBox="0 0 148 154" fill="none" stroke="#ffffff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="32" width="92" height="118" rx="9"/>
                    <line x1="3" y1="58" x2="95" y2="58"/>
                    <circle cx="21" cy="45" r="2.6" fill="#ffffff" stroke="none"/>
                    <circle cx="33" cy="45" r="2.6" fill="#ffffff" stroke="none"/>
                    <line x1="58" y1="45" x2="79" y2="45"/>
                    <circle cx="49" cy="104" r="27"/>
                    <path d="M31 106c6-7 12 7 18 0s12 7 18 0"/>
                    <circle cx="109" cy="15" r="13"/>
                    <circle cx="133" cy="49" r="9"/>
                </svg>
            </div>
            <h1>Sistem Informasi<br>Laundry</h1>
            <p>Layanan Laundry Mudah, Cepat dan Terpercaya</p>
        </div>

        <!-- KANAN: FORM LOGIN -->
        <div class="login-right">
            <div class="form-container">
                <div class="login-header">
                    <h2>Login</h2>
                    <p>Silakan masuk untuk melanjutkan</p>
                </div>

                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <span class="input-icon">
                            <!-- [UBAH 20] Ikon user & gembok jadi solid (sesuai Figma) -->
                            <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><circle cx="12" cy="7.5" r="4.5"/><path d="M3 21c0-4.4 4-7 9-7s9 2.6 9 7v1H3z"/></svg>
                        </span>
                        <input type="text" name="username" placeholder="Username" required autofocus>
                    </div>

                    <div class="input-group">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none"><rect x="4" y="10" width="16" height="12" rx="2" fill="currentColor"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/><circle cx="12" cy="15.5" r="1.6" fill="#ffffff"/></svg>
                        </span>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn-submit">Login</button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>