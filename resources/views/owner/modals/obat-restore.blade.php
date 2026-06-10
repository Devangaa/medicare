<div id="restoreObatModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-md rounded-3xl bg-[#0f172a] border border-emerald-500/20">

        <div class="p-8 text-center">

            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500/10">
                <i class="fa-solid fa-rotate-left text-emerald-400 text-xl"></i>
            </div>

            <h3 class="text-lg font-bold text-white">
                Pulihkan Obat
            </h3>

            <p id="restoreObatText"
                class="mt-3 text-sm text-slate-400">
            </p>

        </div>

        <form id="restoreObatForm" method="POST">
            @csrf

            <div class="p-6 border-t border-slate-800 flex gap-3">

                <button
                    type="button"
                    onclick="closeRestoreObatModal()"
                    class="flex-1 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-sm">
                    Batal
                </button>

                <button
                    type="submit"
                    class="submit-btn flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-sm font-semibold text-white">
                    Pulihkan
                </button>

            </div>

        </form>

    </div>

</div>