<div id="createPembuanganModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-2xl rounded-3xl bg-[#0f172a] border border-slate-700">

        <form action="{{ route('staff.pembuangan-obat.store') }}" method="POST">
            @csrf

            <div class="p-6 border-b border-slate-800">
                <h3 class="text-xl font-bold text-white">
                    Pembuangan Obat
                </h3>
                <p class="text-sm text-slate-400 mt-1">
                    Pilih obat terlebih dahulu, lalu batch.
                </p>
            </div>

            <div class="p-6 space-y-5">

                {{-- OBAT --}}
                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Pilih Obat
                    </label>

                    <select id="obatSelect"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">

                        <option value="">Pilih Obat</option>

                        @foreach($obatAktif as $obat)
                            <option value="{{ $obat->id }}">
                                {{ $obat->nama_obat }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- BATCH --}}
                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Pilih Batch
                    </label>

                    <select name="id_detail_obat" id="batchSelect"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">

                        <option value="">Pilih Batch dulu</option>

                    </select>
                </div>

                {{-- JUMLAH --}}
                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Jumlah Dibuang
                    </label>

                    <input type="number"
                        name="jumlah"
                        min="1"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3">

                <button type="button"
                    onclick="closeCreatePembuanganModal()"
                    class="px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold">
                    Batal
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-sm font-semibold text-white">
                    Buang
                </button>

            </div>

        </form>

    </div>
</div>

<script>
document.getElementById('obatSelect').addEventListener('change', function () {
    let idObat = this.value;
    let batchSelect = document.getElementById('batchSelect');

    batchSelect.innerHTML = '<option>Loading...</option>';

    if (!idObat) {
        batchSelect.innerHTML = '<option>Pilih Obat dulu</option>';
        return;
    }

    fetch(`/staff/obat/${idObat}/batch`)
        .then(res => res.json())
        .then(data => {
            batchSelect.innerHTML = '<option value="">Pilih Batch</option>';

            data.forEach(item => {
                batchSelect.innerHTML += `
                    <option value="${item.id}">
                        Batch: ${item.batch} | Stok: ${item.jumlah_stok}
                    </option>
                `;
            });
        });
});
</script>