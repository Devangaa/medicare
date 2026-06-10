document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const submitBtn = document.getElementById('btn-login');
    const btnText = document.querySelector('.btn-text');
    const btnLoading = document.querySelector('.btn-loading');

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', () => {
            // Nonaktifkan tombol agar tidak bisa diklik dua kali (double-post)
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

            // Tukar teks tombol dengan ikon loading spinner
            if (btnText && btnLoading) {
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
            }
        });
    }
});