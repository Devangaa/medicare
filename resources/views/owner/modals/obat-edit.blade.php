<div id="editObatModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-4xl rounded-3xl bg-[#0f172a] border border-slate-700 max-h-[90vh] overflow-y-auto">

        <div class="p-6 border-b border-slate-800 sticky top-0 bg-[#0f172a] z-10">
            <h3 class="text-lg font-bold text-white">
                Edit Data Obat
            </h3>
        </div>

        <form
            id="editObatForm"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-6 grid md:grid-cols-3 gap-6">

                <!-- FOTO -->
                <div>

                    <label class="text-xs font-bold text-slate-400">
                        Foto Obat
                    </label>

                    <div class="mt-2">

                        <div
                            id="editFotoPreview"
                            class="h-52 rounded-2xl overflow-hidden
                            bg-gradient-to-br from-cyan-500/20 to-blue-500/20
                            border border-cyan-500/20
                            flex items-center justify-center">

                            <img
                                id="editFotoImage"
                                src=""
                                class="hidden w-full h-full object-cover">

                            <span
                                id="editFotoLetter"
                                class="text-5xl font-bold text-cyan-300">
                                O
                            </span>

                        </div>

                        <input
                            type="file"
                            name="foto_obat"
                            id="edit_foto_obat"
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
                            id="editFotoFilename"
                            class="mt-2 text-xs text-slate-500">
                            Belum ada file dipilih
                        </p>

                    </div>

                </div>

                <!-- FORM -->
                <div class="md:col-span-2 grid md:grid-cols-2 gap-5">

                    <div>
                        <label class="text-xs font-bold text-slate-400">
                            Nama Obat
                        </label>

                        <input
                            id="edit_nama_obat"
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
                            id="edit_kode_obat"
                            name="kode_obat"
                            readonly
                            class="mt-2 w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-400 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400">
                            Harga (Rp)
                        </label>

                        <input
                            id="edit_harga"
                            name="harga"
                            type="text"
                            inputmode="numeric"
                            required
                            class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400">
                            Berat (gram)
                        </label>

                        <input
                            id="edit_berat"
                            name="berat"
                            type="text"
                            inputmode="decimal"
                            required
                            class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400">
                            Kategori
                        </label>

                        <select
                            id="edit_kategori"
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
                            id="edit_unit_satuan"
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
                            id="edit_deskripsi"
                            name="deskripsi"
                            rows="5"
                            class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white"></textarea>
                    </div>

                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeEditObatModal()"
                    class="px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold">
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

function openEditObatModal(
    id,
    nama,
    kode,
    harga,
    berat,
    kategori,
    satuan,
    deskripsi,
    foto
) {

    document.getElementById('editObatForm').action =
        `/owner/obat/${id}`;

    document.getElementById('edit_nama_obat').value =
        nama;

    document.getElementById('edit_kode_obat').value =
        kode;

    document.getElementById('edit_harga').value =
        harga;

    document.getElementById('edit_berat').value =
        berat;

    document.getElementById('edit_kategori').value =
        kategori;

    document.getElementById('edit_unit_satuan').value =
        satuan;

    document.getElementById('edit_deskripsi').value =
        deskripsi ?? '';

    document.getElementById('edit_foto_obat').value = '';

    document.getElementById('editFotoFilename')
        .textContent =
        'Belum ada file dipilih';

    const image =
        document.getElementById('editFotoImage');

    const letter =
        document.getElementById('editFotoLetter');

    image.src = '';

    image.classList.add('hidden');

    letter.classList.add('hidden');

    if (foto && foto.trim() !== '') {

        image.onload = function () {

            image.classList.remove('hidden');

            letter.classList.add('hidden');

        };

        image.onerror = function () {

            image.classList.add('hidden');

            letter.textContent =
                nama.charAt(0).toUpperCase();

            letter.classList.remove('hidden');

        };

        image.src = foto;

    } else {

        image.classList.add('hidden');

        letter.textContent =
            nama.charAt(0).toUpperCase();

        letter.classList.remove('hidden');

    }

    document
        .getElementById('editObatModal')
        .classList.remove('hidden');
}

function closeEditObatModal()
{
    document
        .getElementById('editObatModal')
        .classList.add('hidden');
}

const fotoInput =
    document.getElementById('edit_foto_obat');

if (fotoInput)
{
    fotoInput.addEventListener(
        'change',
        function (e)
        {
            const file =
                e.target.files[0];

            if (!file)
                return;

            document.getElementById(
                'editFotoFilename'
            ).textContent = file.name;

            const image =
                document.getElementById(
                    'editFotoImage'
                );

            const letter =
                document.getElementById(
                    'editFotoLetter'
                );

            const reader =
                new FileReader();

            reader.onload = function (
                event
            ) {

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

document.addEventListener(
    'keydown',
    function (e)
    {
        if (e.key === 'Escape')
        {
            closeEditObatModal();
        }
    }
);

</script>