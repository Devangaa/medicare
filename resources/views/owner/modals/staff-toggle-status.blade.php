<div id="toggleStatusModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div id="toggleStatusCard"
        class="relative w-full max-w-md rounded-3xl bg-[#0f172a] border border-rose-500/20">

        <div class="p-8 text-center">

            <div id="toggleStatusIconWrapper"
                class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/10">

                <i id="toggleStatusIcon"
                    class="fa-solid fa-user-slash text-rose-400 text-xl"></i>

            </div>

            <h3 id="toggleStatusTitle"
                class="text-lg font-bold text-white">
                Nonaktifkan Akun
            </h3>

            <p id="toggleStatusText"
                class="mt-3 text-sm text-slate-400">
                Yakin ingin menonaktifkan akun ini?
            </p>

        </div>

        <form id="toggleStatusForm"
            method="POST"
            action="">

            @csrf

            <div class="p-6 border-t border-slate-800 flex gap-3">

                <button
                    type="button"
                    onclick="closeToggleStatusModal()"
                    class="cursor-pointer flex-1 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold hover:bg-slate-700 hover:text-white transition-all">
                    Batal
                </button>

                <button
                    id="toggleStatusButton"
                    type="submit"
                    class="submit-btn cursor-pointer relative flex-1 py-2.5 rounded-xl bg-rose-600 text-white text-sm font-semibold hover:bg-rose-500 transition-all">

                    <span class="btn-text">
                        Nonaktifkan Akun
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