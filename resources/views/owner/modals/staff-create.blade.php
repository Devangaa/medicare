<div id="createStaffModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-2xl rounded-3xl bg-[#0f172a] border border-slate-700 max-h-[90vh] overflow-y-auto">

        <div class="p-6 border-b border-slate-800 sticky top-0 bg-[#0f172a]">
            <h3 class="text-lg font-bold text-white">
                Tambah Staff Baru
            </h3>
        </div>

        <form
            id="createStaffForm"
            method="POST"
            action="{{ route('owner.staff.store') }}">

            @csrf

            <div class="p-6 grid md:grid-cols-2 gap-4">

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        required
                        placeholder="Masukkan nama lengkap"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        required
                        placeholder="Masukkan username"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="Masukkan email"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        required
                        placeholder="Masukkan nomor HP"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="text-xs font-bold text-slate-400">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        required
                        placeholder="Masukkan alamat"
                        class="mt-2 w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white"></textarea>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Password
                    </label>

                    <div class="relative mt-2">

                        <input
                            type="password"
                            name="password"
                            required
                            placeholder="Masukkan password"
                            class="password-input w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 pr-12 text-white focus:outline-none focus:border-blue-500">

                        <button
                            type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white">

                            <i class="eye-open fa-regular fa-eye"></i>
                            <i class="eye-close fa-regular fa-eye-slash hidden"></i>

                        </button>

                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-400">
                        Konfirmasi Password
                    </label>

                    <div class="relative mt-2">

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Konfirmasi password"
                            class="password-input w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 pr-12 text-white focus:outline-none focus:border-blue-500">

                        <button
                            type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white">

                            <i class="eye-open fa-regular fa-eye"></i>
                            <i class="eye-close fa-regular fa-eye-slash hidden"></i>

                        </button>

                    </div>
                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3">

                <button
                    type="button"
                    onclick="closeCreateModal()"
                    class="cursor-pointer px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold">
                    Batal
                </button>

                <button
                    type="submit"
                    class="submit-btn cursor-pointer px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold">
                    <span class="btn-text">
                        Simpan Staff
                    </span>

                    <span class="btn-loading hidden">
                        Loading...
                    </span>
                </button>

            </div>

        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('#createStaffModal .toggle-password').forEach(button => {

            button.addEventListener('click', function () {

                const wrapper = this.closest('.relative');

                const input = wrapper.querySelector('.password-input');
                const eyeOpen = wrapper.querySelector('.eye-open');
                const eyeClose = wrapper.querySelector('.eye-close');

                if (input.type === 'password') {

                    input.type = 'text';

                    eyeOpen.classList.add('hidden');
                    eyeClose.classList.remove('hidden');

                } else {

                    input.type = 'password';

                    eyeOpen.classList.remove('hidden');
                    eyeClose.classList.add('hidden');

                }

            });

        });

});
</script>