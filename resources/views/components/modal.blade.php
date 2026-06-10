@props([
    'id',
    'title' => 'Pemberitahuan',
    'show' => false
])

<div 
    id="{{ $id }}" 
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 {{ $show ? '' : 'hidden' }}"
>
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden transform transition-all">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">{{ $title }}</h3>
            <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                &times;
            </button>
        </div>
        
        <div class="p-6">
            {{ $slot }}
        </div>

        <div class="px-6 py-3 bg-gray-50 flex justify-end">
            <button 
                type="button" 
                onclick="document.getElementById('{{ $id }}').classList.add('hidden')"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none"
            >
                Tutup
            </button>
        </div>
    </div>
</div>