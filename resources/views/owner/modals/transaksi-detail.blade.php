<div
    id="detailModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    {{-- Modal Card --}}
    <div
        class="relative w-full max-w-5xl rounded-3xl bg-[#0f172a] border border-slate-700 overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between p-6 border-b border-slate-800">

            <div>
                <h3 class="text-lg font-bold text-white">
                    Detail Transaksi
                </h3>

                <p class="text-sm text-slate-400 mt-1">
                    Informasi lengkap transaksi penjualan obat.
                </p>
            </div>

        </div>

        {{-- Content --}}
        <div
            id="detailContent"
            class="p-6 max-h-[70vh] overflow-y-auto">
        </div>

        {{-- Footer --}}
        <div class="p-6 border-t border-slate-800 flex justify-end">

            <button
                onclick="closeDetailModal()"
                class="px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-sm text-slate-300 hover:bg-slate-700 transition-all">

                Tutup

            </button>

        </div>

    </div>

</div>