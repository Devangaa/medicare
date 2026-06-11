<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $viewName = $user->role === 'owner' ? 'profile.profile-owner' : 'profile.profile-staff';

        return view($viewName, compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:50|unique:akun,username,'.$user->id,
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:akun,email,'.$user->id,
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $user->update([
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
