<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Menampilkan daftar data staff operasional
     */
    public function index()
    {
        // Mengambil semua data dari tabel akun dengan role staff
        // Kita tidak men-filter is_delete disini agar staff yang dinonaktifkan tetap muncul di list
        $staffs = DB::table('akun')
            ->where('role', 'staff')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('owner.staff', compact('staffs'));
    }

    /**
     * Menambahkan staff baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:akun,username',
            'email' => 'required|email|unique:akun,email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'password' => 'required|min:6|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        Akun::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
            'is_delete' => false,
        ]);

        if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['success' => 'Staff berhasil ditambahkan.']);
        }

        return redirect()
            ->route('owner.staff.index')
            ->with('success', 'Staff berhasil ditambahkan.');
    }

    /**
     * Update data staff
     */
    public function update(Request $request, $id)
    {
        $staff = Akun::findOrFail($id);

        if ($staff->role !== 'staff') {
            abort(403, 'Akses ditolak.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:akun,email,'.$staff->id,
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
        ]);

        $staff->update($validated);

        return redirect()->route('owner.staff.index')
            ->with('success', 'Data staff berhasil diperbarui.');
    }

    /**
     * Reset password staff ke password default
     */
    public function resetPassword(Request $request, $id)
    {
        $staff = Akun::findOrFail($id);

        if ($staff->role !== 'staff') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'new_password' => 'required|min:6|confirmed',
            'owner_password' => 'required',
        ], [
            'new_password.required' => 'Password baru harus diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'owner_password.required' => 'Password owner harus diisi.',
        ]);

        if (! Hash::check(
            $request->owner_password,
            auth()->user()->password
        )) {
            return back()->withErrors([
                'owner_password' => 'Password owner salah.',
            ]);
        }

        $staff->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with(
            'success',
            'Password staff berhasil diperbarui.'
        );
    }

    /**
     * Toggle status aktif/nonaktif staff
     */
    public function toggleStatus($id)
    {
        $staff = Akun::findOrFail($id);

        if ($staff->role !== 'staff') {
            abort(403, 'Akses ditolak.');
        }

        // Toggle is_delete
        $staff->update([
            'is_delete' => ! $staff->is_delete,
        ]);

        $status = $staff->is_delete ? 'nonaktif' : 'aktif';

        return redirect()->route('owner.staff.index')
            ->with('success', "Status staff '{$staff->nama_lengkap}' berhasil diubah menjadi {$status}.");
    }
}
