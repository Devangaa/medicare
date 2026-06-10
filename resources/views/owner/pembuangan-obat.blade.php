@extends('layouts.owner')

@section('title', 'Pembuangan Obat')

@section('content')

<div class="space-y-6">

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

        <h3 class="text-xl font-bold text-white">
            Pembuangan Obat
        </h3>

        <p class="text-sm text-slate-400 mt-1">
            Persetujuan penghapusan obat dari stok.
        </p>

    </div>

    <div
        class="bg-[#0f172a] border border-slate-800 rounded-2xl p-2 flex gap-2">

        <button
            id="tabPendingBtn"
            onclick="switchTab('pending')"
            class="tab-btn flex-1 px-4 py-3 rounded-xl text-sm font-semibold bg-blue-600 text-white">

            Permintaan Pembuangan
            ({{ $pendingPembuangan->count() }})

        </button>

        <button
            id="tabRiwayatBtn"
            onclick="switchTab('riwayat')"
            class="tab-btn flex-1 px-4 py-3 rounded-xl text-sm font-semibold text-slate-400 hover:text-white">

            Riwayat Pembuangan
            ({{ $riwayatPembuangan->count() }})

        </button>

    </div>

    <div id="pendingTab">

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse whitespace-nowrap">

                    <thead>

                        <tr class="border-b border-slate-800 bg-slate-900/40 text-[12px] font-bold uppercase tracking-wider text-slate-400">

                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Obat</th>
                            <th class="px-6 py-4">Stok Tersedia</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Expired</th>
                            <th class="px-6 py-4">Staff</th>
                            <th class="px-6 py-4 text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pendingPembuangan as $item)

                            <tr class="border-b border-slate-800/50">

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ \Carbon\Carbon::parse($item->tanggal_Pembuangan)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ $item->obat->nama_obat }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ number_format($item->detailObat->jumlah_stok) }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ number_format($item->jumlah) }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ \Carbon\Carbon::parse($item->tanggal_expired)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ $item->staff->nama_lengkap }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center gap-2">

                                        <button
                                            onclick="openApproveModal({{ $item->id }}, '{{ $item->obat->nama_obat }}')"
                                            class="h-9 w-9 rounded-xl bg-emerald-600 hover:bg-emerald-500 flex items-center justify-center">

                                            <i class="fa-solid fa-check text-white"></i>

                                        </button>

                                        <button
                                            onclick="openRejectModal({{ $item->id }}, '{{ $item->obat->nama_obat }}')"
                                            class="h-9 w-9 rounded-xl bg-rose-600 hover:bg-rose-500 flex items-center justify-center">

                                            <i class="fa-solid fa-xmark text-white"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7">

                                    <div class="p-12 text-center">

                                        <i class="fa-solid fa-trash-can text-5xl text-slate-600 mb-4"></i>

                                        <h3 class="text-lg font-semibold text-slate-300">
                                            Tidak Ada Permintaan
                                        </h3>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div
        id="riwayatTab"
        class="hidden">

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse whitespace-nowrap">

                    <thead>

                        <tr class="border-b border-slate-800 bg-slate-900/40 text-[12px] font-bold uppercase tracking-wider text-slate-400">

                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Obat</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Staff</th>
                            <th class="px-6 py-4">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($riwayatPembuangan as $item)

                            <tr class="border-b border-slate-800/50">

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pembuangan)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ $item->obat->nama_obat }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ number_format($item->jumlah) }}
                                </td>

                                <td class="px-6 py-4 text-sm text-white">
                                    {{ $item->staff->nama_lengkap }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($item->status == 'approved')

                                        <span
                                            class="px-2.5 py-1 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold uppercase">

                                            Approved

                                        </span>

                                    @else

                                        <span
                                            class="px-2.5 py-1 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-[10px] font-bold uppercase">

                                            Rejected

                                        </span>

                                    @endif

                                </td>

                            </tr>
                            
                        @empty

                            <tr>

                                <td colspan="6">

                                    <div class="p-12 text-center">

                                        <i class="fa-solid fa-trash-can text-5xl text-slate-600 mb-4"></i>

                                        <h3 class="text-lg font-semibold text-slate-300">
                                            Tidak Ada Permintaan
                                        </h3>

                                    </div>

                                </td>

                            </tr>


                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>

    function openApproveModal(id)
    {
        document
            .getElementById('approveForm')
            .action =
            `/owner/pembuangan-obat/${id}/approve`;

        document
            .getElementById('approveModal')
            .classList.remove('hidden');
    }

    function closeApproveModal()
    {
        document
            .getElementById('approveModal')
            .classList.add('hidden');
    }

    function openRejectModal(id)
    {
        document
            .getElementById('rejectForm')
            .action =
            `/owner/pembuangan-obat/${id}/reject`;

        document
            .getElementById('rejectModal')
            .classList.remove('hidden');
    }

    function closeRejectModal()
    {
        document
            .getElementById('rejectModal')
            .classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('form').forEach(form => {

            form.addEventListener('submit', function () {

                const btn =
                    form.querySelector('.submit-btn');

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

    function switchTab(tab)
    {
        const pendingTab =
            document.getElementById('pendingTab');

        const riwayatTab =
            document.getElementById('riwayatTab');

        const pendingBtn =
            document.getElementById('tabPendingBtn');

        const riwayatBtn =
            document.getElementById('tabRiwayatBtn');

        if (tab === 'pending')
        {
            pendingTab.classList.remove('hidden');
            riwayatTab.classList.add('hidden');

            pendingBtn.classList.add(
                'bg-blue-600',
                'text-white'
            );

            pendingBtn.classList.remove(
                'text-slate-400'
            );

            riwayatBtn.classList.remove(
                'bg-blue-600',
                'text-white'
            );

            riwayatBtn.classList.add(
                'text-slate-400'
            );
        }
        else
        {
            riwayatTab.classList.remove('hidden');
            pendingTab.classList.add('hidden');

            riwayatBtn.classList.add(
                'bg-blue-600',
                'text-white'
            );

            riwayatBtn.classList.remove(
                'text-slate-400'
            );

            pendingBtn.classList.remove(
                'bg-blue-600',
                'text-white'
            );

            pendingBtn.classList.add(
                'text-slate-400'
            );
        }
    }

</script>

@include('owner.modals.pembuangan-approve')
@include('owner.modals.pembuangan-reject')

@endsection