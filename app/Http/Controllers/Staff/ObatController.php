<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

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

        $permintaanObat = Obat::with('creator')
            ->where('status', 'pending')
            ->where('id_akun', Auth::id())
            ->get();

        $expiredObat = $obatAktif->filter(function ($obat) {

            return $obat->detailObat->contains(function ($detail) {

                return \Carbon\Carbon::parse(
                    $detail->tanggal_kadaluwarsa
                )->isPast();

            });

        });

        $hampirExpiredObat = $obatAktif->filter(function ($obat) {

            return $obat->detailObat->contains(function ($detail) {

                $tanggal = \Carbon\Carbon::parse(
                    $detail->tanggal_kadaluwarsa
                );

                return $tanggal->isFuture()
                    && now()->diffInDays($tanggal) <= 30;

            });

        });

        return view(
            'staff.obat',
            compact(
                'obatAktif',
                'obatDihapus',
                'permintaanObat',
                'expiredObat',
                'hampirExpiredObat'
            )
        );
    }

    public function store()
    {
        request()->validate([
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

        do {

            $kodeObat = 'OBT-' . mt_rand(100000, 999999);

        } while (
            Obat::where('kode_obat', $kodeObat)->exists()
        );

        Obat::create([
            'nama_obat' => request('nama_obat'),
            'kode_obat' => $kodeObat,
            'harga' => request('harga'),
            'berat' => request('berat'),
            'kategori' => request('kategori'),
            'unit_satuan' => request('unit_satuan'),
            'deskripsi' => request('deskripsi'),
            'status' => 'pending',
            'is_delete' => false,
            'id_akun' => Auth::id(),
        ]);

        return back()->with(
            'success',
            'Permintaan obat berhasil dikirim.'
        );
    }
}