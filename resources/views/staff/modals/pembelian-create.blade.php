<div id="createPembelianModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-2xl rounded-3xl bg-[#0f172a] border border-slate-700">

        <form
            action="{{ route('staff.pembelian-obat.store') }}"
            method="POST"

            @csrf

            <div class="p-6 border-b border-slate-800">

                <h3 class="text-xl font-bold text-white">
                    Tambah Stok Obat
                </h3>

                <p class="text-sm text-slate-400 mt-1">
                    Tambahkan stok baru ke gudang.
                </p>

            </div>

            <div class="p-6 space-y-5">

                {{-- Obat --}}
                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Pilih Obat
                    </label>

                    <select
                        name="id_obat"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">

                        <option value="">
                            Pilih Obat
                        </option>

                        @foreach($obatAktif as $obat)

                            <option value="{{ $obat->id }}">
                                {{ $obat->nama_obat }}
                                ({{ $obat->kode_obat }})
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Jumlah --}}
                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Jumlah Pembelian
                    </label>

                    <input
                        type="number"
                        min="1"
                        name="jumlah_stok"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">

                </div>

                {{-- Expired --}}
                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Tanggal Kadaluarsa
                    </label>

                    <input
                        type="date"
                        name="tanggal_kadaluwarsa"
                        required
                        min="{{ now()->toDateString() }}"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">

                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeCreatePembelianModal()"
                    class="px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold">

                    Batal

                </button>

                <button
                    type="submit"
                    class="submit-btn px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold text-white">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>