<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Cari admin berdasarkan username
    $user = DB::table('admin')
        ->where('username', $request->username)
        ->first();

if ($user) {
    // Periksa jenis password yang tersimpan
    $passwordInfo = password_get_info((string) $user->password);

    $passwordCocok = false;

    if ($passwordInfo['algoName'] === 'bcrypt') {
        // Jika password sudah berbentuk hash Bcrypt
        $passwordCocok = Hash::check(
            $request->password,
            $user->password
        );
    } elseif ($passwordInfo['algoName'] === 'unknown') {
        // Jika password masih berupa teks biasa
        $passwordCocok = hash_equals(
            (string) $user->password,
            (string) $request->password
        );

        if ($passwordCocok) {
            // Ubah password lama menjadi hash
            $passwordBaru = Hash::make($request->password);

            DB::table('admin')
                ->where('id_admin', $user->id_admin)
                ->update([
                    'password' => $passwordBaru,
                ]);

            $user->password = $passwordBaru;
        }
    }

    if ($passwordCocok) {
        // Simpan session login admin
        session([
            'admin' => $user,
            'admin_id' => $user->id_admin,
            'admin_username' => $user->username,
            'logged_in' => true,
        ]);

        return redirect()->route('dashboard');
    }
}

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
}

    public function logout(Request $request)
    {
        // Hapus semua session yang aktif
        $request->session()->flush();
        
        // Redirect kembali ke halaman login
        return redirect()->route('login');
    }
}