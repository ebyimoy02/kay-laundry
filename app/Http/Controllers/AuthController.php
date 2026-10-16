<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Cek data ke tabel admin
        $user = DB::table('admin')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        
if ($user) {
    // Simpan session login admin
    session([
        'admin' => $user,
        'admin_id' => $user->id_admin,
        'admin_username' => $user->username,
        'logged_in' => true,
    ]);

    return redirect()->route('dashboard');
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