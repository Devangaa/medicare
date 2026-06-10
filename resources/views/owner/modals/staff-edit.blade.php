<div id="editStaffModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-2xl rounded-3xl bg-[#0f172a] border border-slate-700 shadow-2xl max-h-[90vh] overflow-y-auto">

        <div class="p-6 border-b border-slate-800 sticky top-0 bg-[#0f172a]">
            <h3 class="text-lg font-bold text-white">
                Edit Data Staff
            </h3>
        </div>

        <form id="editStaffForm" method="POST" action="" accept-charset="UTF-8">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-4">

                @if($errors->any() && ($errors->has('nama_lengkap') || $errors->has('email') || $errors->has('no_hp') || $errors->has('alamat')))
                    <div class="bg-rose-500/10 border border-rose-500/20 rounded-lg p-4">
                        <p class="text-rose-400 text-sm font-semibold mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            Ada kesalahan pada formulir
                        </p>
                        <ul class="space-y-1 text-rose-400 text-xs">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle text-[4px]"></i>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">Nama Lengkap</label>
                    <input
                        id="edit_nama_lengkap"
                        type="text"
                        name="nama_lengkap"
                        class="mt-1 w-full rounded-xl bg-slate-900 border {{ $errors->has('nama_lengkap') ? 'border-rose-500' : 'border-slate-700' }} px-4 py-3 text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">Email</label>
                    <input
                        id="edit_email"
                        type="email"
                        name="email"
                        class="mt-1 w-full rounded-xl bg-slate-900 border {{ $errors->has('email') ? 'border-rose-500' : 'border-slate-700' }} px-4 py-3 text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">Nomor HP</label>
                    <input
                        id="edit_no_hp"
                        type="text"
                        name="no_hp"
                        class="mt-1 w-full rounded-xl bg-slate-900 border {{ $errors->has('no_hp') ? 'border-rose-500' : 'border-slate-700' }} px-4 py-3 text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">Alamat</label>
                    <textarea
                        id="edit_alamat"
                        name="alamat"
                        rows="3"
                        class="mt-1 w-full rounded-xl bg-slate-900 border {{ $errors->has('alamat') ? 'border-rose-500' : 'border-slate-700' }} px-4 py-3 text-white focus:outline-none focus:border-blue-500 resize-none"
                        required></textarea>
                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3 sticky bottom-0 bg-[#0f172a]">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="cursor-pointer px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold hover:bg-slate-700 hover:text-white transition-all"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="submit-btn cursor-pointer relative min-w-[140px] px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-500 transition-all"
                >
                    <span class="btn-text">
                        Simpan Perubahan
                    </span>

                    <span class="btn-loading hidden">
                        <svg class="animate-spin h-5 w-5 mx-auto text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24">
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4">
                            </circle>

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                    </span>
                </button>

            </div>

        </form>
    </div>
</div>