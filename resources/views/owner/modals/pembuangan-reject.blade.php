<div id="rejectModal"
class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <form
        id="rejectForm"
        method="POST"
        class="relative w-full max-w-md rounded-3xl bg-[#0f172a] border border-slate-700">

        @csrf
        @method('PUT')

        <div class="p-6">

            <h3 class="text-lg font-bold text-white">
                Tolak Pembuangan?
            </h3>

            <p class="text-sm text-slate-400 mt-2">
                Stok tidak akan dikurangi dan data pembuangan akan tetap disimpan sebagai riwayat.
            </p>

        </div>

        <div class="p-6 border-t border-slate-800 flex gap-3">

            <button type="button"
                onclick="closeRejectModal()"
                class="flex-1 py-2.5 rounded-xl bg-slate-800">
                Batal
            </button>

            <button
                class="flex-1 py-2.5 rounded-xl bg-rose-600 text-white">
                Tolak
            </button>

        </div>

    </form>

</div>