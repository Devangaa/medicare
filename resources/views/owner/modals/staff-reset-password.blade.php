<div id="resetPasswordModal"
    class="hidden fixed inset-0 z-[999] flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/80 backdrop-blur-md"></div>

    <div class="relative w-full max-w-lg rounded-3xl bg-[#0f172a] border border-slate-700 max-h-[90vh] overflow-y-auto">

        <div class="p-6 border-b border-slate-800 sticky top-0 bg-[#0f172a]">
            <h3 class="text-lg font-bold text-white">
                Reset Password Staff
            </h3>
        </div>

        <form id="resetPasswordForm" method="POST" action="" accept-charset="UTF-8">
            @csrf

            <div class="p-6 space-y-4">

                @if($errors->any() && ($errors->has('new_password') || $errors->has('password_confirmation') || $errors->has('owner_password')))
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
                    <label class="block text-xs font-bold tracking-wider text-slate-400">
                        Password Baru
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="new_password"
                            placeholder="Masukkan password baru"
                            class="password-input w-full bg-slate-900 border {{ $errors->has('new_password') ? 'border-rose-500' : 'border-slate-700' }} rounded-xl px-4 py-3 pr-12 text-sm text-white focus:outline-none focus:border-amber-500"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white"
                        >
                            <i class="eye-open fa-regular fa-eye"></i>
                            <i class="eye-close fa-regular fa-eye-slash hidden"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">
                        Konfirmasi Password Baru
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="new_password_confirmation"
                            placeholder="Konfirmasi password baru"
                            class="password-input w-full bg-slate-900 border {{ $errors->has('password_confirmation') ? 'border-rose-500' : 'border-slate-700' }} rounded-xl px-4 py-3 pr-12 text-sm text-white focus:outline-none focus:border-amber-500"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white"
                        >
                            <i class="eye-open fa-regular fa-eye"></i>
                            <i class="eye-close fa-regular fa-eye-slash hidden"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-bold tracking-wider text-slate-400">
                        Password Owner (Konfirmasi)
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="owner_password"
                            placeholder="Masukkan password anda"
                            class="password-input w-full bg-slate-900 border {{ $errors->has('owner_password') ? 'border-rose-500' : 'border-slate-700' }} rounded-xl px-4 py-3 pr-12 text-sm text-white focus:outline-none focus:border-amber-500"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white"
                        >
                            <i class="eye-open fa-regular fa-eye"></i>
                            <i class="eye-close fa-regular fa-eye-slash hidden"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="p-6 border-t border-slate-800 flex justify-end gap-3 sticky bottom-0 bg-[#0f172a]">

                <button
                    type="button"
                    onclick="closeResetPasswordModal()"
                    class="cursor-pointer px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-800 text-slate-300 text-sm font-semibold hover:bg-slate-700 hover:text-white transition-all"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="submit-btn cursor-pointer relative min-w-[140px] px-4 py-2.5 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-400 transition-all"
                >
                    <span class="btn-text">
                        Reset Password
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('#resetPasswordModal .toggle-password').forEach(button => {

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