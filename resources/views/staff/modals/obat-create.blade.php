<div id="createObatModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-4xl rounded-3xl bg-[#0f172a] border border-slate-700">    
    
    <form
        action="{{ route('staff.obat.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="p-6 grid md:grid-cols-3 gap-6">


            {{-- FOTO --}}
            <div>

                <label class="text-xs font-bold text-slate-400">
                    Foto Obat (Opsional)
                </label>

                <div class="mt-2">

                    <div
                        class="h-52 rounded-2xl overflow-hidden
                        bg-gradient-to-br from-cyan-500/20 to-blue-500/20
                        border border-cyan-500/20
                        flex items-center justify-center">

                        <img
                            id="createFotoImage"
                            class="hidden w-full h-full object-cover">

                        <span
                            id="createFotoLetter"
                            class="text-5xl font-bold text-cyan-300">

                            O

                        </span>

                    </div>

                    <input
                        type="file"
                        name="foto_obat"
                        id="create_foto_obat"
                        accept="image/*"
                        class="mt-3 w-full text-sm text-slate-400
                        file:mr-4
                        file:px-4
                        file:py-2
                        file:rounded-xl
                        file:border-0
                        file:bg-blue-600
                        file:text-white
                        file:text-sm
                        hover:file:bg-blue-500">

                    <p
                        id="createFotoFilename"
                        class="mt-2 text-xs text-slate-500">

                        Belum ada file dipilih

                    </p>

                </div>

            </div>

            {{-- FORM --}}
            <div class="md:col-span-2 grid md:grid-cols-2 gap-5">

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Nama Obat
                    </label>

                    <input
                        id="create_nama_obat"
                        name="nama_obat"
                        type="text"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white">

                </div>

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Kode Obat
                    </label>

                    <input
                        type="text"
                        value="Dibuat otomatis oleh sistem"
                        readonly
                        class="mt-2 w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-400 cursor-not-allowed">

                </div>

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Harga (Rp)
                    </label>

                    <input
                        type="text"
                        inputmode="numeric"
                        name="harga"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white">

                </div>

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Berat (gram)
                    </label>

                    <input
                        type="text"
                        inputmode="decimal"
                        name="berat"
                        required
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white">

                </div>

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white appearance-none">

                        <option value="Antibiotik">Antibiotik</option>
                        <option value="Analgesik">Analgesik</option>
                        <option value="Antipiretik">Antipiretik</option>
                        <option value="Vitamin">Vitamin</option>
                        <option value="Suplemen">Suplemen</option>
                        <option value="Antasida">Antasida</option>
                        <option value="Antihistamin">Antihistamin</option>
                        <option value="Obat Batuk">Obat Batuk</option>
                        <option value="Obat Flu">Obat Flu</option>
                        <option value="Obat Kulit">Obat Kulit</option>

                    </select>

                </div>

                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Satuan
                    </label>

                    <select
                        name="unit_satuan"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white appearance-none">

                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Strip">Strip</option>
                        <option value="Botol">Botol</option>
                        <option value="Tube">Tube</option>
                        <option value="Sachet">Sachet</option>
                        <option value="Ampul">Ampul</option>
                        <option value="Vial">Vial</option>
                        <option value="Pcs">Pcs</option>

                    </select>

                </div>

                <div class="md:col-span-2">

                    <label class="text-xs font-bold text-slate-400">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white"></textarea>

                </div>

            </div>

        </div>

        <div class="p-6 border-t border-slate-800 flex justify-end gap-3">

            <button
                type="button"
                onclick="closeCreateObatModal()"
                class="cursor-pointer px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold hover:bg-slate-700 hover:text-white transition-all"
            >
                Batal
            </button>

            <button
                type="submit"
                class="submit-btn px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-sm font-semibold text-white">
                Simpan Perubahan
            </button>

        </div>

    </form>

    </div>

</div>

<script>

    const createFotoInput =
        document.getElementById('create_foto_obat');

    if (createFotoInput)
    {
        createFotoInput.addEventListener(
            'change',
            function(e)
            {
                const file =
                    e.target.files[0];

                if (!file)
                    return;

                document.getElementById(
                    'createFotoFilename'
                ).textContent =
                    file.name;

                const image =
                    document.getElementById(
                        'createFotoImage'
                    );

                const letter =
                    document.getElementById(
                        'createFotoLetter'
                    );

                const reader =
                    new FileReader();

                reader.onload = function(event)
                {
                    image.src =
                        event.target.result;

                    image.classList.remove(
                        'hidden'
                    );

                    letter.classList.add(
                        'hidden'
                    );
                };

                reader.readAsDataURL(file);
            }
        );
    }

    document
        .getElementById('create_nama_obat')
        ?.addEventListener(
            'input',
            function()
            {
                const letter =
                    document.getElementById(
                        'createFotoLetter'
                    );

                if (letter)
                {
                    letter.textContent =
                        this.value.length
                        ? this.value.charAt(0).toUpperCase()
                        : 'O';
                }
            }
        );

</script>