@extends('layouts.staff')

@section('title', 'Profil Staff')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

        <h2 class="text-2xl font-bold text-white mb-6">
            Profil Akun
        </h2>

        @if(session('success'))
            <div class="bg-green-500/20 text-green-400 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label class="text-slate-300">Username</label>
                    <input
                        type="text"
                        name="username"
                        value="{{ $user->username }}"
                        class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">
                </div>

                <div>
                    <label class="text-slate-300">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama_lengkap"
                        value="{{ $user->nama_lengkap }}"
                        class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">
                </div>

                <div>
                    <label class="text-slate-300">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ $user->email }}"
                        class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">
                </div>

                <div>
                    <label class="text-slate-300">No HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ $user->no_hp }}"
                        class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">
                </div>

            </div>

            <div class="mt-4">
                <label class="text-slate-300">Alamat</label>
                <textarea
                    name="alamat"
                    rows="3"
                    class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">{{ $user->alamat }}</textarea>
            </div>

            <div class="mt-4">
                <label class="text-slate-300">
                    Password Baru (Opsional)
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full mt-1 bg-slate-900 border border-slate-700 rounded-lg p-3 text-white">
            </div>

            <button
                type="submit"
                class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                Simpan Perubahan

            </button>

        </form>

    </div>

</div>

@endsection
