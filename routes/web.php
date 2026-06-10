<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\StaffController;
use App\Http\Controllers\Owner\ObatController;
use App\Http\Controllers\Owner\TransaksiController;
use App\Http\Controllers\Owner\PembelianController;
use App\Http\Controllers\Owner\PembuanganController;
use App\Http\Controllers\ProfileController;

// ==========================================
// RUTE ROOT - REDIRECT KE DASHBOARD/LOGIN
// ==========================================
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }
    }
    return redirect()->route('login');
})->name('home');

// ==========================================
// RUTE UMUM / GUEST (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==========================================
// RUTE YANG WAJIB LOGIN (AUTH)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // 1. Fitur Umum: Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 2. Fitur Umum: Profil Saya (Bisa diakses oleh semua session: Owner & Staff)
    // URL-nya menjadi: 127.0.0.1:8000/profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    // ==========================================
    // KELOMPOK HALAMAN KHUSUS OWNER
    // ==========================================
    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function () {
        
        // Menu 1: Dashboard Owner
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Menu 2: Data Staff
        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        // Tambahkan rute CRUD staff lainnya disini jika diperlukan, contoh:
        // Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
        
        // Menu 3: Data Obat
        Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
        
        // Menu 4: Transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        
        // Menu 5: Pembelian Obat
        Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
        
        // Menu 6: Pembuangan Obat
        Route::get('/pembuangan', [PembuanganController::class, 'index'])->name('pembuangan.index');
    });


    // ==========================================
    // KELOMPOK HALAMAN KHUSUS STAFF
    // ==========================================
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
        
        // Dashboard Staff
        Route::get('/dashboard', function () {
            return "Halo Staff Operasional! Ini halaman kerjamu.";
        })->name('dashboard');
        
        // Kamu bisa tambahkan rute input transaksi / pembuangan obat versi staff disini nanti...
    });

});