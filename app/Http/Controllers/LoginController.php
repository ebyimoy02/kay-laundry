<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_id')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where(
            'username',
            $credentials['username']
        )->first();

        if (!$admin || !Hash::check(
            $credentials['password'],
            $admin->password
        )) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->withInput(
                    $request->only('username')
                );
        }

        $request->session()->regenerate();

        session([
            'admin_id' => $admin->id_admin,
            'admin_username' => $admin->username,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'admin_username',
        ]);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}