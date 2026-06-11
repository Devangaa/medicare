@extends('layouts.staff')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

        <h3 class="text-xl font-bold text-white">
            Dashboard Staff
        </h3>

        <p class="text-sm text-slate-400 mt-1">
            Ringkasan aktivitas dan informasi akun anda.
        </p>

    </div>

    {{-- Statistik --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Transaksi
                    </p>

                    <h3 class="text-3xl font-bold text-white mt-2">
                        {{ number_format($totalTransaksi) }}
                    </h3>

                </div>

                <div class="h-14 w-14 rounded-2xl bg-blue-500/10 flex items-center justify-center">

                    <i class="fa-solid fa-wallet text-blue-400 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Request Pembelian
                    </p>

                    <h3 class="text-3xl font-bold text-white mt-2">
                        {{ number_format($totalPembelian) }}
                    </h3>

                </div>

                <div class="h-14 w-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center">

                    <i class="fa-solid fa-cart-shopping text-emerald-400 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Request Pembuangan
                    </p>

                    <h3 class="text-3xl font-bold text-white mt-2">
                        {{ number_format($totalPembuangan) }}
                    </h3>

                </div>

                <div class="h-14 w-14 rounded-2xl bg-rose-500/10 flex items-center justify-center">

                    <i class="fa-solid fa-trash-can text-rose-400 text-xl"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Informasi Staff + Quick Menu --}}
    <div class="grid lg:grid-cols-2 gap-6">

        {{-- Informasi Staff --}}
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

            <h3 class="text-lg font-bold text-white mb-5">
                Informasi Akun
            </h3>

            <div class="space-y-4">

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Nama Lengkap
                    </p>

                    <p class="text-sm text-white mt-1">
                        {{ $user->nama_lengkap }}
                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Username
                    </p>

                    <p class="text-sm text-white mt-1">
                        {{ $user->username }}
                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Role
                    </p>

                    <span class="inline-flex mt-1 px-3 py-1 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase">
                        Staff
                    </span>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-wider text-slate-500">
                        Bergabung
                    </p>

                    <p class="text-sm text-white mt-1">
                        {{ $user->created_at->format('d M Y') }}
                    </p>

                </div>

            </div>

        </div>

        {{-- Quick Access --}}
        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

            <h3 class="text-lg font-bold text-white mb-5">
                Akses Cepat
            </h3>

            <div class="grid grid-cols-2 gap-4">

                {{-- Kasir --}}
                <a
                    href="#"
                    class="col-span-2 p-5 rounded-2xl border border-green-500/20 bg-green-500/10 hover:bg-green-500/20 transition-all flex items-center gap-4">

                    <div class="h-12 w-12 rounded-xl bg-green-500/20 flex items-center justify-center">

                        <i class="fa-solid fa-cash-register text-green-400 text-xl"></i>

                    </div>

                    <div>

                        <h4 class="text-sm font-bold text-white">
                            Kasir
                        </h4>

                        <p class="text-xs text-slate-400 mt-1">
                            Buat transaksi penjualan obat
                        </p>

                    </div>

                </a>

                {{-- Data Obat --}}
                <a
                    href="{{ url('/staff/obat') }}"
                    class="p-5 rounded-2xl border border-slate-800 bg-slate-900/40 hover:border-cyan-500 transition-all">

                    <i class="fa-solid fa-capsules text-cyan-400 text-xl mb-3"></i>

                    <h4 class="text-sm font-semibold text-white">
                        Data Obat
                    </h4>

                </a>

                {{-- Transaksi --}}
                <a
                    href="{{ url('/staff/transaksi') }}"
                    class="p-5 rounded-2xl border border-slate-800 bg-slate-900/40 hover:border-emerald-500 transition-all">

                    <i class="fa-solid fa-wallet text-emerald-400 text-xl mb-3"></i>

                    <h4 class="text-sm font-semibold text-white">
                        Transaksi
                    </h4>

                </a>

                {{-- Pembelian --}}
                <a
                    href="{{ url('/staff/pembelian-obat') }}"
                    class="p-5 rounded-2xl border border-slate-800 bg-slate-900/40 hover:border-yellow-500 transition-all">

                    <i class="fa-solid fa-cart-shopping text-yellow-400 text-xl mb-3"></i>

                    <h4 class="text-sm font-semibold text-white">
                        Pembelian
                    </h4>

                </a>

                {{-- Pembuangan --}}
                <a
                    href="{{ url('/staff/pembuangan-obat') }}"
                    class="p-5 rounded-2xl border border-slate-800 bg-slate-900/40 hover:border-rose-500 transition-all">

                    <i class="fa-solid fa-trash-can text-rose-400 text-xl mb-3"></i>

                    <h4 class="text-sm font-semibold text-white">
                        Pembuangan
                    </h4>

                </a>

            </div>

        </div>

    </div>

</div>

@endsection