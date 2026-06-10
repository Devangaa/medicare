<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // Validasi input data dari form view login
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tambahkan pengecekan agar akun yang sudah di-soft delete tidak bisa login
        $credentials['is_delete'] = false;

        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil data user yang berhasil login
            $user = Auth::user();
            
            // Cek role untuk mengarahkan halaman (Menggunakan rute bernama agar lebih aman)
            if ($user->role === 'owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard');
            }

            return redirect()->intended('/');
        }

        // Jika login gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah atau akun dinonaktifkan.',
        ])->onlyInput('username');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}