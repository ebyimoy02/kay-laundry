<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengaturanAkunController extends Controller
{
    public function index()
    {
        $adminId = session('admin_id');

        $admin = DB::table('admin')
            ->where('id_admin', $adminId)
            ->first();

        if (!$admin) {
            return redirect()->route('login');
        }

        return view('pengaturan-akun.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $adminId = session('admin_id');

        $admin = DB::table('admin')
            ->where('id_admin', $adminId)
            ->first();

        if (!$admin) {
            return redirect()->route('login');
        }

        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('admin', 'username')
                    ->ignore($adminId, 'id_admin'),
            ],
            'current_password' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'Password saat ini tidak sesuai.',
                ])
                ->withInput($request->only('username'));
        }

        $data = [
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        DB::table('admin')
            ->where('id_admin', $adminId)
            ->update($data);

        session(['admin_username' => $request->username]);

        return back()->with(
            'success',
            'Pengaturan akun berhasil diperbarui.'
        );
    }
}