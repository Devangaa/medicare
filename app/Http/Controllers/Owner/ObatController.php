<?php

namespace App\Http\Controllers\Owner;

use App\Models\DetailObat;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obatAktif = Obat::with([
                'detailObat',
                'creator'
            ])
            ->where('status', 'approved')
            ->where('is_delete', false)
            ->latest()
            ->get();

        $obatDihapus = Obat::with([
                'detailObat',
                'creator'
            ])
            ->where('is_delete', true)
            ->latest()
            ->get();

        $permintaanObat = Obat::with([
                'detailObat',
                'creator'
            ])
            ->where('status', 'pending')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI EXPIRED
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $expiredObat = DetailObat::with('obat')
            ->whereDate(
                'tanggal_kadaluwarsa',
                '<',
                $today
            )
            ->whereHas('obat', function ($q) {
                $q->where('is_delete', false)
                ->where('status', 'approved');
            })
            ->get();

        $hampirExpiredObat = DetailObat::with('obat')
            ->whereDate(
                'tanggal_kadaluwarsa',
                '>=',
                $today
            )
            ->whereDate(
                'tanggal_kadaluwarsa',
                '<=',
                $today->copy()->addDays(30)
            )
            ->whereHas('obat', function ($q) {
                $q->where('is_delete', false)
                ->where('status', 'approved');
            })
            ->get();

        return view(
            'owner.obat',
            compact(
                'obatAktif',
                'obatDihapus',
                'permintaanObat',
                'expiredObat',
                'hampirExpiredObat'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $validated = $request->validate([
            'nama_obat'     => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'required|numeric|min:0',
            'berat'         => 'required|numeric|min:0',
            'kategori'      => 'required|string|max:100',
            'unit_satuan'   => 'required|string|max:50',
            'foto_obat'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'berat.required' => 'Berat wajib diisi.',
            'berat.min' => 'Berat tidak boleh kurang dari 0.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'unit_satuan.required' => 'Satuan wajib dipilih.',
            'foto_obat.image' => 'File harus berupa gambar.',
            'foto_obat.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto_obat.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        // Upload foto baru
        if ($request->hasFile('foto_obat')) {

            // Hapus foto lama
            if (
                $obat->foto_obat &&
                Storage::disk('public')->exists($obat->foto_obat)
            ) {
                Storage::disk('public')
                    ->delete($obat->foto_obat);
            }

            $validated['foto_obat'] = $request
                ->file('foto_obat')
                ->store('obat', 'public');
        }

        $obat->update($validated);

        return back()->with(
            'success',
            'Data obat berhasil diperbarui.'
        );
    }

    public function approve($id)
    {
        $obat = Obat::findOrFail($id);

        $obat->update([
            'status' => 'approved'
        ]);

        return back()->with(
            'success',
            'Permintaan obat berhasil disetujui.'
        );
    }

    public function reject($id)
    {
        $obat = Obat::findOrFail($id);

        $obat->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Permintaan obat berhasil ditolak.'
        );
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);

        $obat->update([
            'is_delete' => true
        ]);

        return back()->with(
            'success',
            'Obat berhasil dinonaktifkan.'
        );
    }

    public function restore($id)
    {
        $obat = Obat::findOrFail($id);

        $obat->update([
            'is_delete' => false
        ]);

        return back()->with(
            'success',
            'Obat berhasil diaktifkan kembali.'
        );
    }
}