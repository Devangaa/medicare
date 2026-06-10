@extends('layouts.owner')

@section('title', 'Dashboard Utama')

<!-- Mengisi Ikon di Atas Navbar -->
@section('page_icon')
    <i class="fa-solid fa-chart-pie text-blue-500"></i>
@endsection

<!-- Mengisi Judul Halaman di Navbar -->
@section('page_name', 'Dashboard')

@section('content')
    <!-- Tulis konten isi dashboard di sini, misal box statistik -->
    <div class="space-y-6">
        <div class="bg-[#0f172a] border border-slate-800 p-6 rounded-2xl">
            <h3 class="text-xl font-bold text-white">Selamat Datang Kembali, Owner!</h3>
            <p class="text-slate-400 text-sm mt-1">Berikut ringkasan data apotek Medicare saat ini.</p>
        </div>
        
        <!-- Grid Statistik Box -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Box Contoh -->
            <div class="bg-[#0f172a] border border-slate-800 p-5 rounded-2xl">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Total Transaksi</span>
                <div class="text-2xl font-bold text-white mt-2">Rp15.000.000</div>
            </div>
        </div>
    </div>
@endsection