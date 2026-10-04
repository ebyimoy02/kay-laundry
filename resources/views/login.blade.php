<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #ffffff;
        }

        .login-wrapper {
            display: flex;
            width: 100vw;
            height: 100vh;
        }

        /* SISI KIRI - NAVY FULLSCREEN */
        .login-left {
            flex: 1;
            background-color: #0b2e59;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .login-left .icon-box {
            margin-bottom: 24px;
        }

        .login-left h1 {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 12px;
        }

        .login-left p {
            font-size: 15px;
            color: #cbd5e1;
            font-weight: 300;
            max-width: 380px;
            line-height: 1.5;
        }

        /* SISI KANAN - FORM FULLSCREEN */
        .login-right {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            width: 100%;
            max-width: 380px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header h2 {
            font-size: 28px;
            color: #0b2e59;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            color: #64748b;
        }

        /* INPUT FIELD DENGAN IKON */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            display: flex;
            align-items: center;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-group input:focus {
            border-color: #0b2e59;
            box-shadow: 0 0 0 3px rgba(11, 46, 89, 0.1);
        }

        .btn-submit {
            width: 100%;
            background-color: #0b2e59;
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: #071e3d;
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

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }
            .login-left {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">

        <!-- KIRI: INFORMASI LAUNDRY -->
        <div class="login-left">
            <div class="icon-box">
                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                    <circle cx="12" cy="13" r="4"/>
                    <path d="M12 11c1 0 1 1 2 1s1-1 2-1"/>
                    <circle cx="7" cy="7" r="1" fill="#ffffff"/>
                    <circle cx="10" cy="7" r="1" fill="#ffffff"/>
                    <circle cx="18" cy="5" r="1.5" stroke-width="1.5"/>
                    <circle cx="20" cy="8" r="1" stroke-width="1.5"/>
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
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" name="username" placeholder="Username" required autofocus>
                    </div>

                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
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