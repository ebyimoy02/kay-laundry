@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pengaturan-akun.css') }}">
@endpush

@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')

<div class="account-settings-page">

    <div class="account-page-heading">
    <h1>Pengaturan Akun</h1>
    <p>Kelola username dan password akun Kay Laundry.</p>
</div>

    @if (session('success'))
        <div class="account-alert account-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="account-settings-card">

        <div class="account-settings-header">
            <h2>Informasi Akun</h2>
            <p>Ubah informasi login akun Anda di bawah ini.</p>
        </div>

        <form
            action="{{ route('pengaturan-akun.update') }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="account-form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username', $admin->username) }}"
                    required
                    autocomplete="username"
                >

                @error('username')
                    <small class="account-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="account-form-group">
                <label for="current_password">Password Saat Ini</label>

                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    placeholder="Masukkan password saat ini"
                    required
                    autocomplete="current-password"
                >

                @error('current_password')
                    <small class="account-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="account-form-group">
                <label for="password">Password Baru</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password baru (opsional)"
                    autocomplete="new-password"
                >

                @error('password')
                    <small class="account-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="account-form-group">
                <label for="password_confirmation">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password baru"
                    autocomplete="new-password"
                >
            </div>

            <div class="account-form-info">
                Kosongkan password baru jika hanya ingin mengganti username.
            </div>

            <div class="account-form-actions">

                <a href="{{ route('dashboard') }}" class="account-btn-cancel">
                    Kembali
                </a>

                <button type="submit" class="account-btn-save">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection