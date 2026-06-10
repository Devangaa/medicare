@extends('layouts.app')

@section('title', 'Login — Medicare')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden bg-[#0f172a] px-4 py-12 sm:px-6 lg:px-8 version-medicare" style="font-family: 'Inter', sans-serif;">
    
    <div class="absolute top-[-10%] left-[-10%] h-[350px] w-[350px] sm:h-[550px] sm:w-[550px] rounded-full bg-blue-600/15 blur-[120px] sm:blur-[140px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] h-[350px] w-[350px] sm:h-[550px] sm:w-[550px] rounded-full bg-teal-500/10 blur-[120px] sm:blur-[140px]"></div>
    
    <div class="relative z-10 flex flex-col items-center justify-center mb-8 text-center animate-fade-in animate-duration-300">
        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-blue-400 mb-3 shadow-xl border border-white/10 backdrop-blur-md ring-4 ring-white/5">
            <i class="fa-solid fa-heart-pulse text-3xl animate-pulse"></i>
        </div>
        <h1 class="text-2xl font-extrabold tracking-wider text-white uppercase sm:text-3xl">
            Medicare
        </h1>
    </div>

    <div class="relative z-10 w-full max-w-md space-y-8 rounded-3xl bg-white/[0.97] p-8 sm:p-10 shadow-2xl backdrop-blur-xl border border-white/20">
        
        <div class="text-center space-y-1.5">
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Selamat Datang Kembali!
            </h2>
            <p class="text-sm text-slate-500  max-w-xs mx-auto">
                Silakan masuk untuk mengelola data dan layanan kesehatan
            </p>
        </div>

        <form id="login-form" action="{{ url('/login') }}" method="POST" class="mt-8 space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="username" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Username
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <input 
                        id="username" 
                        name="username" 
                        type="text" 
                        required 
                        value="{{ old('username') }}"
                        class="block w-full rounded-xl border border-slate-200 px-4 py-3.5 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none text-sm bg-slate-50/50 transition-all font-medium" 
                        placeholder="Masukkan akun Medicare anda"
                    >
                </div>
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Password
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="block w-full rounded-xl border border-slate-200 pl-4 pr-12 py-3.5 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none text-sm bg-slate-50/50 transition-all font-medium" 
                        placeholder="Masukkan password anda"
                    >
                    
                    <button 
                        type="button" 
                        id="toggle-password" 
                        class="cursor-pointer absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-blue-600 transition-colors focus:outline-none"
                    >
                        <svg id="eye-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        
                        <svg id="eye-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.128-5.416m5.662-1.664A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-4.225-4.225L3 3m7.243 7.243a3 3 0 104.243 4.243" />
                        </svg>
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="rounded-xl bg-red-50 p-4 border border-red-100 animate-shake">
                    <div class="flex items-start gap-3 text-red-600">
                        <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span class="text-xs font-semibold leading-relaxed">
                            {{ $errors->first() }}
                        </span>
                    </div>
                </div>
            @endif

            <div class="pt-2">
                <button 
                    type="submit" 
                    id="btn-login"
                    class="cursor-pointer relative flex w-full justify-center rounded-xl bg-blue-600 px-4 py-3.5 text-sm font-bold text-white hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/20 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <span class="btn-text tracking-wide">Masuk</span>
                    
                    <span class="btn-loading hidden">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('toggle-password');
        const eyeOpenIcon = document.getElementById('eye-open');
        const eyeClosedIcon = document.getElementById('eye-closed');

        togglePasswordButton.addEventListener('click', function () {
            // Cek tipe input saat ini
            if (passwordInput.type === 'password') {
                // Ubah ke teks biasa (Lihat password)
                passwordInput.type = 'text';
                eyeOpenIcon.classList.add('hidden');
                eyeClosedIcon.classList.remove('hidden');
            } else {
                // Kembalikan ke password (Sembunyikan password)
                passwordInput.type = 'password';
                eyeOpenIcon.classList.remove('hidden');
                eyeClosedIcon.classList.add('hidden');
            }
        });
    });
</script>
@endsection