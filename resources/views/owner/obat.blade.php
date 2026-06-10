@extends('layouts.owner')

@section('title', 'Data Obat')

@section('content')

<div class="space-y-6">
    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-white">
            Manajemen Data Obat
        </h3>

        <p class="text-slate-400 text-sm mt-1">
            Kelola seluruh data obat yang tersedia.
        </p>

    </div>

    <div class="grid md:grid-cols-5 gap-4">

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase">
                Obat Aktif
            </p>

            <h2 class="text-3xl font-bold text-white mt-2">
                {{ $obatAktif->count() }}
            </h2>
        </div>

        <div class="bg-[#0f172a] border border-amber-500/20 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase">
                        Hampir Expired
                    </p>
                    <h2 class="text-3xl font-bold text-amber-400 mt-2">
                        {{ $hampirExpiredObat->count() }}
                    </h2>
                </div>
                <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-400"></i>
            </div>
        </div>

        <div class="bg-[#0f172a] border border-rose-500/20 rounded-2xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs uppercase">
                        Sudah Expired
                    </p>
                    <h2 class="text-3xl font-bold text-rose-400 mt-2">
                        {{ $expiredObat->count() }}
                    </h2>
                </div>
                <i class="fa-solid fa-skull-crossbones text-2xl text-rose-400"></i>
            </div>
        </div>

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase">
                Permintaan
            </p>

            <h2 class="text-3xl font-bold text-amber-400 mt-2">
                {{ $permintaanObat->count() }}
            </h2>
        </div>

        <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-5">
            <p class="text-slate-400 text-xs uppercase">
                Obat Dihapus
            </p>

            <h2 class="text-3xl font-bold text-rose-400 mt-2">
                {{ $obatDihapus->count() }}
            </h2>
        </div>

    </div>

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-2">

        <div class="flex gap-2">

            <button
                onclick="switchTab('aktif')"
                id="tab-aktif-btn"
                class="tab-btn bg-blue-600 text-white px-4 py-2 rounded-xl">

                Stok Obat
                ({{ $obatAktif->count() }})
            </button>

            <button
                onclick="switchTab('deleted')"
                id="tab-deleted-btn"
                class="tab-btn px-4 py-2 rounded-xl text-slate-400">

                Obat Dihapus
                ({{ $obatDihapus->count() }})
            </button>

            <button
                onclick="switchTab('request')"
                id="tab-request-btn"
                class="tab-btn px-4 py-2 rounded-xl text-slate-400">

                Permintaan Obat
                ({{ $permintaanObat->count() }})
            </button>

        </div>

    </div>

    <div id="tab-aktif" class="tab-content">

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">

            @forelse($obatAktif as $obat)

                <div class="bg-[#0f172a] border border-slate-800 rounded-2xl overflow-hidden hover:border-slate-700 transition-all">

                    <div class="p-4 relative">

                        @php
                            $expiredCount = $obat->detailObat
                                ->filter(function ($detail) {
                                    return \Carbon\Carbon::parse(
                                        $detail->tanggal_kadaluwarsa
                                    )->isPast();
                                })
                                ->count();

                            $hampirExpiredCount = $obat->detailObat
                                ->filter(function ($detail) {

                                    $tanggal = \Carbon\Carbon::parse(
                                        $detail->tanggal_kadaluwarsa
                                    );

                                    return $tanggal->isFuture()
                                        && now()->diffInDays($tanggal) <= 30;

                                })
                                ->count();
                        @endphp

                        @if($expiredCount > 0)
                            <div
                                class="absolute
                                    top-7
                                    left-7
                                    z-10">

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        gap-1
                                        px-2.5
                                        py-1
                                        rounded-xl
                                        bg-rose-600
                                        text-white
                                        text-[10px]
                                        font-bold
                                        uppercase
                                        shadow-lg">

                                    <i class="fa-solid fa-skull-crossbones"></i>

                                    {{ $expiredCount }} Expired

                                </span>

                            </div>

                        @elseif($hampirExpiredCount > 0)

                            <div
                                class="absolute
                                    top-7
                                    left-7
                                    z-10">

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        gap-1
                                        px-2.5
                                        py-1
                                        rounded-xl
                                        bg-amber-500
                                        text-white
                                        text-[10px]
                                        font-bold
                                        uppercase
                                        shadow-lg">

                                    <i class="fa-solid fa-triangle-exclamation"></i>

                                    Hampir Expired

                                </span>

                            </div>
                        @endif

                        @if($obat->foto_obat)

                            <img
                                src="{{ asset('storage/'.$obat->foto_obat) }}"
                                class="h-44 w-full object-cover rounded-2xl">

                        @else

                            <div class="h-44 rounded-2xl flex items-center justify-center bg-indigo-500/15 border border-indigo-500/20">

                                <span class="text-5xl font-bold text-indigo-300">
                                    {{ strtoupper(substr($obat->nama_obat,0,1)) }}
                                </span>

                            </div>

                        @endif

                    </div>

                    <div class="px-5 pb-5">

                        <h3 class="font-bold text-white">
                            {{ $obat->nama_obat }}
                        </h3>

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $obat->kode_obat }}
                        </p>

                        <div class="mt-4 space-y-2 text-sm">

                            <div class="flex justify-between">
                                <span class="text-slate-400">Stok</span>
                                <span class="font-bold text-emerald-400">
                                    {{ $obat->total_stok }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-400">Harga</span>
                                <span class="text-white">
                                    Rp {{ number_format($obat->harga,0,',','.') }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-400">Kategori</span>
                                <span class="text-white">
                                    {{ $obat->kategori }}
                                </span>
                            </div>

                        </div>

                        <div class="flex justify-center gap-2 mt-5">

                            <button
                                onclick="openEditObatModal(
                                    {{ $obat->id }},
                                    '{{ addslashes($obat->nama_obat) }}',
                                    '{{ $obat->kode_obat }}',
                                    '{{ $obat->harga }}',
                                    '{{ $obat->berat }}',
                                    '{{ $obat->kategori }}',
                                    '{{ $obat->unit_satuan }}',
                                    '{{ addslashes($obat->deskripsi ?? '') }}',
                                    '{{ $obat->foto_obat ? asset('storage/'.$obat->foto_obat) : '' }}'
                                )"
                                class="h-9 w-9 rounded-xl bg-slate-800 hover:bg-blue-600 flex items-center justify-center text-slate-300 hover:text-white transition-all">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button
                                onclick='openStokObatModal(
                                    "{{ addslashes($obat->nama_obat) }}",
                                    @json($obat->detailObat)
                                )'
                                class="cursor-pointer h-9 w-9 rounded-xl bg-amber-500/15 text-amber-400 hover:bg-amber-500 hover:text-white transition-all">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </button>

                            <button
                                onclick="openDeleteObatModal(
                                    {{ $obat->id }},
                                    '{{ addslashes($obat->nama_obat) }}'
                                )"
                                class="cursor-pointer h-9 w-9 rounded-xl bg-rose-500/15 text-rose-400 hover:bg-rose-600 hover:text-white transition-all">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-12 text-center">

                        <i class="fa-solid fa-capsules text-5xl text-slate-600 mb-4"></i>

                        <h3 class="text-lg font-semibold text-slate-300">
                            Belum Ada Data Obat
                        </h3>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

    <div id="tab-deleted" class="tab-content hidden">

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">

            @forelse($obatDihapus as $obat)

                <div class="bg-[#0f172a] border border-rose-500/20 rounded-2xl overflow-hidden">

                    <div class="p-4">

                        @if($obat->foto_obat)

                            <img
                                src="{{ asset('storage/'.$obat->foto_obat) }}"
                                class="h-44 w-full object-cover rounded-2xl">

                        @else

                            <div class="h-44 rounded-2xl flex items-center justify-center bg-indigo-500/15 border border-indigo-500/20">

                                <span class="text-5xl font-bold text-indigo-300">
                                    {{ strtoupper(substr($obat->nama_obat,0,1)) }}
                                </span>

                            </div>

                        @endif

                    </div>

                    <div class="px-5 pb-5">

                        <div class="flex justify-between items-center">

                            <h3 class="font-bold text-white">
                                {{ $obat->nama_obat }}
                            </h3>

                            <span class="px-2 py-1 rounded-lg text-[10px] bg-rose-500/10 text-rose-400 font-bold">
                                DIHAPUS
                            </span>

                        </div>

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $obat->kode_obat }}
                        </p>

                        <div class="flex justify-center gap-2 mt-5">

                            <button
                                onclick='openStokObatModal(
                                    "{{ addslashes($obat->nama_obat) }}",
                                    @json($obat->detailObat)
                                )'
                                class="cursor-pointer h-9 w-9 rounded-xl bg-amber-500/15 text-amber-400 hover:bg-amber-500 hover:text-white transition-all">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </button>

                            <button
                                onclick="openRestoreObatModal(
                                    {{ $obat->id }},
                                    '{{ addslashes($obat->nama_obat) }}'
                                )"
                                class="h-9 w-9 rounded-xl bg-emerald-500/15 text-emerald-400 hover:bg-emerald-600 hover:text-white">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-12 text-center">

                        <i class="fa-solid fa-trash-can text-5xl text-slate-600 mb-4"></i>

                        <h3 class="text-lg font-semibold text-slate-300">
                            Tidak Ada Obat Dihapus
                        </h3>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

    <div id="tab-request" class="tab-content hidden">

        <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-5">

            @forelse($permintaanObat as $obat)

                <div class="bg-[#0f172a] border border-amber-500/20 rounded-2xl overflow-hidden">

                    <div class="p-4">

                        @if($obat->foto_obat)

                            <img
                                src="{{ asset('storage/'.$obat->foto_obat) }}"
                                class="h-44 w-full object-cover rounded-2xl">

                        @else

                            <div class="h-44 rounded-2xl flex items-center justify-center bg-indigo-500/15 border border-indigo-500/20">

                                <span class="text-5xl font-bold text-indigo-300">
                                    {{ strtoupper(substr($obat->nama_obat,0,1)) }}
                                </span>

                            </div>

                        @endif

                    </div>

                    <div class="px-5 pb-5">

                        <div class="flex justify-between items-center">

                            <h3 class="font-bold text-white">
                                {{ $obat->nama_obat }}
                            </h3>

                            <span class="px-2 py-1 rounded-lg text-[10px] bg-amber-500/10 text-amber-400 font-bold">
                                PENDING
                            </span>

                        </div>

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $obat->kode_obat }}
                        </p>

                        <div class="mt-4 text-xs text-slate-400">

                            Pengaju:

                            <span class="text-white">
                                {{ $obat->creator->nama_lengkap ?? '-' }}
                            </span>

                        </div>

                        <div class="flex justify-center gap-2 mt-5">

                            <button
                                onclick="openApproveObatModal(
                                    {{ $obat->id }},
                                    '{{ addslashes($obat->nama_obat) }}'
                                )"
                                class="h-9 w-9 rounded-xl bg-emerald-500/15 text-emerald-400 hover:bg-emerald-600 hover:text-white">
                                <i class="fa-solid fa-check"></i>
                            </button>

                         

                            <button
                                onclick="openRejectObatModal(
                                    {{ $obat->id }},
                                    '{{ addslashes($obat->nama_obat) }}'
                                )"
                                class="h-9 w-9 rounded-xl bg-rose-500/15 text-rose-400 hover:bg-rose-600 hover:text-white">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-12 text-center">

                        <i class="fa-solid fa-clock text-5xl text-slate-600 mb-4"></i>

                        <h3 class="text-lg font-semibold text-slate-300">
                            Tidak Ada Permintaan Obat
                        </h3>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

<script>
    function switchTab(tab)
    {
        document
            .querySelectorAll('[id^="tab-"]')
            .forEach(el => {

                if (
                    el.id === 'tab-aktif' ||
                    el.id === 'tab-deleted' ||
                    el.id === 'tab-request'
                ) {
                    el.classList.add('hidden');
                }

            });

        document
            .getElementById('tab-' + tab)
            .classList.remove('hidden');

        document
            .querySelectorAll('.tab-btn')
            .forEach(btn => {

                btn.classList.remove(
                    'bg-blue-600',
                    'text-white'
                );

                btn.classList.add(
                    'text-slate-400'
                );
            });

        document
            .getElementById('tab-' + tab + '-btn')
            .classList.add(
                'bg-blue-600',
                'text-white'
            );
    }
</script>

<script>

    /*
    |--------------------------------------------------------------------------
    | EDIT OBAT
    |--------------------------------------------------------------------------
    */

    function openEditObatModal(
        id,
        nama,
        kode,
        harga,
        berat,
        kategori,
        satuan,
        deskripsi
    ) {

        const form = document.getElementById('editObatForm');

        form.action = `/owner/obat/${id}`;

        document.getElementById('edit_nama_obat').value = nama;
        document.getElementById('edit_kode_obat').value = kode;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_berat').value = berat;
        document.getElementById('edit_kategori').value = kategori;
        document.getElementById('edit_unit_satuan').value = satuan;
        document.getElementById('edit_deskripsi').value = deskripsi ?? '';

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


    /*
    |--------------------------------------------------------------------------
    | LIHAT STOK
    |--------------------------------------------------------------------------
    */

    function openStokObatModal(
        namaObat,
        stok
    ) {

        const container =
            document.getElementById('stokContent');

        let html = `
            <div class="mb-5">
                <h4 class="text-lg font-bold text-white">
                    ${namaObat}
                </h4>

                <p class="text-sm text-slate-400">
                    Detail stok per batch obat
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-800 text-xs uppercase text-slate-500">
                            <th class="pb-3">Batch</th>
                            <th class="pb-3">Stok</th>
                            <th class="pb-3">Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        stok.forEach(item => {

            html += `
                <tr class="border-b border-slate-800/50">

                    <td class="py-3 text-sm text-white">
                        ${item.batch}
                    </td>

                    <td class="py-3 text-sm text-emerald-400 font-semibold">
                        ${item.jumlah_stok}
                    </td>

                    <td class="py-3 text-sm text-slate-300">
                        ${item.tanggal_kadaluwarsa}
                    </td>

                </tr>
            `;

        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        container.innerHTML = html;

        document
            .getElementById('stokObatModal')
            .classList.remove('hidden');
    }

    function closeStokObatModal()
    {
        document
            .getElementById('stokObatModal')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS OBAT
    |--------------------------------------------------------------------------
    */

    function openDeleteObatModal(
        id,
        namaObat
    ) {

        document
            .getElementById('deleteObatForm')
            .action =
            `/owner/obat/${id}/delete`;

        document
            .getElementById('deleteObatText')
            .textContent =
            `Yakin ingin menghapus obat ${namaObat}?`;

        document
            .getElementById('deleteObatModal')
            .classList.remove('hidden');
    }

    function closeDeleteObatModal()
    {
        document
            .getElementById('deleteObatModal')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | PULIHKAN OBAT
    |--------------------------------------------------------------------------
    */

    function openRestoreObatModal(
        id,
        namaObat
    ) {

        document
            .getElementById('restoreObatForm')
            .action =
            `/owner/obat/${id}/restore`;

        document
            .getElementById('restoreObatText')
            .textContent =
            `Yakin ingin memulihkan obat ${namaObat}?`;

        document
            .getElementById('restoreObatModal')
            .classList.remove('hidden');
    }

    function closeRestoreObatModal()
    {
        document
            .getElementById('restoreObatModal')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | SETUJUI PERMINTAAN
    |--------------------------------------------------------------------------
    */

    function openApproveObatModal(
        id,
        namaObat
    ) {

        document
            .getElementById('approveObatForm')
            .action =
            `/owner/obat/${id}/approve`;

        document
            .getElementById('approveObatText')
            .textContent =
            `Setujui permintaan penambahan obat ${namaObat}?`;

        document
            .getElementById('approveObatModal')
            .classList.remove('hidden');
    }

    function closeApproveObatModal()
    {
        document
            .getElementById('approveObatModal')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | TOLAK PERMINTAAN
    |--------------------------------------------------------------------------
    */

    function openRejectObatModal(
        id,
        namaObat
    ) {

        document
            .getElementById('rejectObatForm')
            .action =
            `/owner/obat/${id}/reject`;

        document
            .getElementById('rejectObatText')
            .textContent =
            `Tolak permintaan penambahan obat ${namaObat}?`;

        document
            .getElementById('rejectObatModal')
            .classList.remove('hidden');
    }

    function closeRejectObatModal()
    {
        document
            .getElementById('rejectObatModal')
            .classList.add('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | AUTO LOADING BUTTON
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL CLICK OUTSIDE
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (e) {

        [
            'editObatModal',
            'stokObatModal',
            'deleteObatModal',
            'restoreObatModal',
            'approveObatModal',
            'rejectObatModal'
        ].forEach(id => {

            const modal =
                document.getElementById(id);

            if (!modal) return;

            if (
                e.target === modal
            ) {
                modal.classList.add('hidden');
            }

        });

    });

</script>

@include('owner.modals.obat-edit')
@include('owner.modals.obat-stok')
@include('owner.modals.obat-delete')
@include('owner.modals.obat-restore')
@include('owner.modals.obat-approve')
@include('owner.modals.obat-reject')

@endsection