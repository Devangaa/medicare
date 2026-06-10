<form action="{{ url('/login') }}" method="POST" class="mt-6">
    @csrf

    <x-input 
        type="text" 
        name="username" 
        label="Username Akun" 
        placeholder="Masukkan username Anda..." 
        required 
    />

    <x-input 
        type="password" 
        name="password" 
        label="Kata Sandi" 
        placeholder="••••••••" 
        required 
    />

    <div class="flex items-center justify-between mb-6">
        <label class="flex items-center text-sm text-gray-600">
            <input type="checkbox" name="remember" class="mr-2 rounded"> Ingat Saya
        </label>
    </div>

    <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-200">
        Masuk ke Sistem
    </button>
</form>