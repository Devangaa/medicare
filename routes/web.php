<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ObatController as OwnerObatController;
use App\Http\Controllers\Owner\PembelianObatController as OwnerPembelianObatController;
use App\Http\Controllers\Owner\PembuanganObatController as OwnerPembuanganObatController;
use App\Http\Controllers\Owner\StaffController as OwnerStaffController;
use App\Http\Controllers\Owner\TransaksiController as OwnerTransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Staff\KasirController as StaffKasirController;
use App\Http\Controllers\Staff\ObatController as StaffObatController;
use App\Http\Controllers\Staff\PembelianObatController as StaffPembelianObatController;
use App\Http\Controllers\Staff\PembuanganObatController as StaffPembuanganObatController;
use App\Http\Controllers\Staff\TransaksiController as StaffTransaksiController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');

        // Menu 2: Data Staff
        Route::get('/staff', [OwnerStaffController::class, 'index'])->name('staff.index');
        Route::post('/staff', [OwnerStaffController::class, 'store'])->name('staff.store');
        Route::put('/staff/{id}/edit', [OwnerStaffController::class, 'update'])->name('staff.update');
        Route::post('/staff/{id}/reset-password', [OwnerStaffController::class, 'resetPassword'])->name('staff.reset-password');
        Route::post('/staff/{id}/toggle-status', [OwnerStaffController::class, 'toggleStatus'])->name('staff.toggle-status');

        // Menu 3: Data Obat
        Route::get('/obat', [OwnerObatController::class, 'index'])->name('obat.index');
        Route::put('/obat/{id}', [OwnerObatController::class, 'update'])->name('obat.update');
        Route::post('/obat/{id}/approve', [OwnerObatController::class, 'approve'])->name('obat.approve');
        Route::post('/obat/{id}/reject', [OwnerObatController::class, 'reject'])->name('obat.reject');
        Route::post('/obat/{id}/delete', [OwnerObatController::class, 'destroy'])->name('obat.delete');
        Route::post('/obat/{id}/restore', [OwnerObatController::class, 'restore'])->name('obat.restore');

        // Menu 4: Transaksi
        Route::get('/transaksi', [OwnerTransaksiController::class, 'index'])->name('transaksi.index');

        // Menu 5: Pembelian Obat
        Route::get('/pembelian-obat', [OwnerPembelianObatController::class, 'index'])->name('owner.pembelian-obat.index');
        Route::put('/pembelian-obat/{id}/approve', [OwnerPembelianObatController::class, 'approve']);
        Route::put('/pembelian-obat/{id}/reject', [OwnerPembelianObatController::class, 'reject']);

        // Menu 6: Pembuangan Obat
        Route::get('/pembuangan-obat', [OwnerPembuanganObatController::class, 'index'])->name('owner.pembuangan-obat.index');
        Route::patch('/pembuangan-obat/{id}/approve', [OwnerPembuanganObatController::class, 'approve']);
        Route::patch('/pembuangan-obat/{id}/reject', [OwnerPembuanganObatController::class, 'reject']);
    });

    // ==========================================
    // KELOMPOK HALAMAN KHUSUS STAFF
    // ==========================================
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {

        // Menu 1: Dashboard
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

        // Menu 2: Data Obat
        Route::get('/obat', [StaffObatController::class, 'index'])->name('obat.index');
        Route::post('/obat', [StaffObatController::class, 'store'])->name('obat.store');

        // Menu 3: Transaksi
        Route::get('/transaksi', [StaffTransaksiController::class, 'index'])->name('transaksi.index');

        // Menu 4: Pembelian Obat
        Route::get('/pembelian-obat', [StaffPembelianObatController::class, 'index'])->name('pembelian-obat.index');
        Route::post('/pembelian-obat', [StaffPembelianObatController::class, 'store'])->name('pembelian-obat.store');

        // Menu 5: Pembuangan Obat
        Route::get('/pembuangan-obat', [StaffPembuanganObatController::class, 'index'])->name('pembuangan-obat.index');
        Route::post('/pembuangan-obat', [StaffPembuanganObatController::class, 'store'])->name('pembuangan-obat.store');
        Route::get('/obat/{id}/batch', [StaffPembuanganObatController::class, 'getBatchByObat'])->name('staff.pembuangan-obat.batch');

        // Menu 6: Kasir
        Route::get('/kasir', [StaffKasirController::class, 'index'])->name('kasir.index');
        Route::post('/kasir/checkout', [StaffKasirController::class, 'checkout'])->name('kasir.checkout');
        Route::get('/kasir/obat/{id}/batch', [StaffKasirController::class, 'getBatch'])->name('kasir.batch');
    });

});
