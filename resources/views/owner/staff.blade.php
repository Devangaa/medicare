@extends('layouts.owner')

@section('title', 'Manajemen Data Staff')

@section('page_icon')
    <i class="fa-solid fa-users text-teal-400 text-sm"></i>
@endsection

@section('page_name', 'Data Staff')

@section('content')
<div class="space-y-6 animate-fade-in">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#0f172a] border border-slate-800 p-5 rounded-2xl shadow-xl">
        <div>
            <h3 class="text-lg font-bold text-white tracking-wide">Daftar Akun Staff</h3>
            <p class="text-slate-400 text-xs mt-1">Kelola hak akses, biodata, dan status keaktifan staff apotek Medicare.</p>
        </div>
        <div>
            <button class="cursor-pointer w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold rounded-xl shadow-lg shadow-blue-600/20 active:scale-[0.98] transition-all">
                <i class="fa-solid fa-user-plus"></i>
                <span>Tambah Staff Baru</span>
            </button>
        </div>
    </div>

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl shadow-2xl overflow-hidden">
        
        <div class="w-full overflow-x-auto scrolling-touch">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/40 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        <th class="py-4 px-6">Nama Lengkap</th>
                        <th class="py-4 px-6">Username</th>
                        <th class="py-4 px-6">Kontak & Email</th>
                        <th class="py-4 px-6">Alamat</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @forelse($staffs as $staff)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-xs text-white">
                                        {{ strtoupper(substr($staff->nama_lengkap, 0, 2)) }}
                                    </div>
                                    <span class="font-semibold text-white">{{ $staff->nama_lengkap }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 font-mono text-xs text-slate-400">
                                @<span>{{ $staff->username }}</span>
                            </td>
                            
                            <td class="py-4 px-6">
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-xs font-medium text-slate-200">{{ $staff->email }}</span>
                                    <span class="text-[11px] text-slate-500 font-mono">{{ $staff->no_hp }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 max-w-xs truncate text-xs text-slate-400">
                                {{ $staff->alamat }}
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                @if(!$staff->is_delete)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-400"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="openEditModal({{ $staff->id }}, '{{ addslashes($staff->nama_lengkap) }}', '{{ $staff->email }}', '{{ $staff->no_hp }}', '{{ addslashes($staff->alamat) }}')" title="Edit Data" class="cursor-pointer h-7 w-7 rounded-lg bg-slate-800 text-slate-300 hover:bg-blue-600 hover:text-white border border-slate-700 transition-all flex items-center justify-center text-xs">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    
                                    <button onclick="openResetPasswordModal({{ $staff->id }}, '{{ $staff->nama_lengkap }}')" title="Reset Password" class="cursor-pointer h-7 w-7 rounded-lg bg-slate-800 text-amber-500 hover:bg-amber-500 hover:text-white border border-slate-700/80 transition-all flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-key"></i> 
                                    </button>

                                    <button onclick="openToggleStatusModal({{ $staff->id }}, '{{ $staff->nama_lengkap }}', {{ $staff->is_delete ? 'true' : 'false' }})" title="Ubah Status Aktif" class="cursor-pointer h-7 w-7 rounded-lg bg-slate-800 {{ !$staff->is_delete ? 'text-rose-400 hover:bg-rose-600' : 'text-emerald-400 hover:bg-emerald-600' }} hover:text-white border border-slate-700 transition-all flex items-center justify-center text-xs">
                                        <i class="fa-solid {{ !$staff->is_delete ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500">
                                <i class="fa-solid fa-users-slash text-4xl mb-3 block text-slate-600"></i>
                                <span class="text-sm">Belum ada data staff operasional yang terdaftar.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-slate-900/20 border-t border-slate-800/60 px-6 py-4 flex items-center justify-between text-xs text-slate-400">
            <span>Menampilkan {{ count($staffs) }} entri staff</span>
            <div class="flex items-center gap-1">
                <button class="px-2.5 py-1.5 rounded-lg bg-slate-800 border border-slate-700 text-slate-500 cursor-not-allowed" disabled><i class="fa-solid fa-chevron-left"></i></button>
                <button class="px-3 py-1.5 rounded-lg bg-blue-600 text-white font-semibold">1</button>
                <button class="px-2.5 py-1.5 rounded-lg bg-slate-800 border border-slate-700 hover:bg-slate-700 transition-colors"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

    </div>
</div>

<script>
    let currentStaffId = null;

    function openEditModal(staffId, namaLengkap, email, noHp, alamat) {
        currentStaffId = staffId;
        const form = document.getElementById('editStaffForm');
        form.action = `/owner/staff/${staffId}`;
        document.getElementById('edit_nama_lengkap').value = namaLengkap;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_hp').value = noHp;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('editStaffModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editStaffModal').classList.add('hidden');
    }

    function openResetPasswordModal(staffId, namaLengkap) {
        currentStaffId = staffId;
        const form = document.getElementById('resetPasswordForm');
        form.action = `/owner/staff/${staffId}/reset-password`;
        form.reset();
        document.getElementById('resetPasswordModal').classList.remove('hidden');
    }

    function closeResetPasswordModal() {
        document.getElementById('resetPasswordModal').classList.add('hidden');
    }

    function openToggleStatusModal(staffId, namaLengkap, isDeleted) {

        document.getElementById('toggleStatusForm').action =
            `/owner/staff/${staffId}/toggle-status`;

        const card = document.getElementById('toggleStatusCard');
        const title = document.getElementById('toggleStatusTitle');
        const text = document.getElementById('toggleStatusText');

        const iconWrapper = document.getElementById('toggleStatusIconWrapper');
        const icon = document.getElementById('toggleStatusIcon');

        const button = document.getElementById('toggleStatusButton');
        const buttonText = button.querySelector('.btn-text');

        if (isDeleted) {

            // AKTIFKAN

            title.textContent = 'Aktifkan Akun';

            text.textContent =
                `Yakin ingin mengaktifkan kembali akun ${namaLengkap}?`;

            card.className =
                'relative w-full max-w-md rounded-3xl bg-[#0f172a] border border-emerald-500/20';

            iconWrapper.className =
                'mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500/10';

            icon.className =
                'fa-solid fa-user-check text-emerald-400 text-xl';

            button.className =
                'submit-btn cursor-pointer relative flex-1 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-500 transition-all';

            buttonText.textContent =
                'Aktifkan Akun';

        } else {

            // NONAKTIFKAN

            title.textContent = 'Nonaktifkan Akun';

            text.textContent =
                `Yakin ingin menonaktifkan akun ${namaLengkap}?`;

            card.className =
                'relative w-full max-w-md rounded-3xl bg-[#0f172a] border border-rose-500/20';

            iconWrapper.className =
                'mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-rose-500/10';

            icon.className =
                'fa-solid fa-user-slash text-rose-400 text-xl';

            button.className =
                'submit-btn cursor-pointer relative flex-1 py-2.5 rounded-xl bg-rose-600 text-white text-sm font-semibold hover:bg-rose-500 transition-all';

            buttonText.textContent =
                'Nonaktifkan Akun';
        }

        document.getElementById('toggleStatusModal')
            .classList.remove('hidden');
    }

    function closeToggleStatusModal() {
        document.getElementById('toggleStatusModal').classList.add('hidden');
    }

    // Show modals if there are errors
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            @if($errors->has('nama_lengkap') || $errors->has('email') || $errors->has('no_hp') || $errors->has('alamat'))
                if (currentStaffId) {
                    const form = document.getElementById('editStaffForm');
                    form.action = `/owner/staff/${currentStaffId}`;
                }
                document.getElementById('editStaffModal').classList.remove('hidden');
            @elseif($errors->has('new_password') || $errors->has('password_confirmation') || $errors->has('owner_password'))
                if (currentStaffId) {
                    const form = document.getElementById('resetPasswordForm');
                    form.action = `/owner/staff/${currentStaffId}/reset-password`;
                }
                document.getElementById('resetPasswordModal').classList.remove('hidden');
            @endif
        @endif

        // Form submit handlers to ensure action is set and prevent invalid submissions
        const editStaffForm = document.getElementById('editStaffForm');
        const resetPasswordForm = document.getElementById('resetPasswordForm');
        const toggleStatusForm = document.getElementById('toggleStatusForm');

        if (editStaffForm) {
            editStaffForm.addEventListener('submit', function (e) {
                if (!this.action || this.action === '' || !this.action.includes('/owner/staff/')) {
                    e.preventDefault();
                    alert('Error: Form action tidak diset dengan benar. Silakan buka modal kembali.');
                    return false;
                }
            });
        }

        if (resetPasswordForm) {
            resetPasswordForm.addEventListener('submit', function (e) {
                if (!this.action || this.action === '' || !this.action.includes('/reset-password')) {
                    e.preventDefault();
                    alert('Error: Form action tidak diset dengan benar. Silakan buka modal kembali.');
                    return false;
                }
            });
        }

        if (toggleStatusForm) {
            toggleStatusForm.addEventListener('submit', function (e) {
                if (!this.action || this.action === '' || !this.action.includes('/toggle-status')) {
                    e.preventDefault();
                    alert('Error: Form action tidak diset dengan benar. Silakan buka modal kembali.');
                    return false;
                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('form').forEach(form => {

            form.addEventListener('submit', function () {

                const btn = form.querySelector('.submit-btn');

                if (!btn) return;

                btn.disabled = true;

                btn.classList.add(
                    'opacity-70',
                    'cursor-not-allowed'
                );

                btn.querySelector('.btn-text')
                    ?.classList.add('hidden');

                btn.querySelector('.btn-loading')
                    ?.classList.remove('hidden');

            });

        });

    });
</script>

@include('owner.modals.staff-edit')
@include('owner.modals.staff-reset-password')
@include('owner.modals.staff-toggle-status')

@endsection