@extends('layouts.staff')

@section('title', 'Data Transaksi')

@section('content')

<div class="space-y-6">

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">

        <h3 class="text-xl font-bold text-white">
            Data Transaksi
        </h3>

        <p class="text-sm text-slate-400 mt-1">
            Riwayat seluruh transaksi penjualan obat.
        </p>

    </div>

    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead>

                    <tr class="border-b border-slate-800 bg-slate-900/40 text-[12px] font-bold uppercase tracking-wider text-slate-400">

                        <th class="px-6 py-4">
                            Tanggal
                        </th>

                        <th class="px-6 py-4">
                            Total Harga
                        </th>

                        <th class="px-6 py-4">
                            Pembayaran
                        </th>

                        <th class="px-6 py-4">
                            Staff
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transaksi as $item)

                        <tr class="border-b border-slate-800/50">

                            <td class="px-6 py-4 text-sm text-white">
                                {{ $item->tanggal_transaksi->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-sm font-semibold text-emerald-400">
                                Rp {{ number_format($item->total_harga,0,',','.') }}
                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="px-2.5 py-1 rounded-xl bg-blue-500/10 text-blue-400 text-[10px] font-bold uppercase">

                                    {{ $item->metode_pembayaran }}

                                </span>

                            </td>

                            <td class="px-6 py-4 text-sm text-white">
                                {{ $item->staff->nama_lengkap ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center">

                                    <button
                                        onclick='openDetailModal(@json($item))'
                                        class="h-9 w-9 rounded-xl bg-slate-800 hover:bg-blue-600 flex items-center justify-center text-slate-300 hover:text-white transition-all">

                                        <i class="fa-solid fa-eye"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                <div class="p-12 text-center">

                                    <i class="fa-solid fa-receipt text-5xl text-slate-600 mb-4"></i>

                                    <h3 class="text-lg font-semibold text-slate-300">
                                        Belum Ada Transaksi
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

<script>

function openDetailModal(data)
{
    const totalHarga = data.detail_transaksi.reduce(
        (total, item) => total + parseFloat(item.total_harga),
        0
    );

    const tanggal = new Date(data.tanggal_transaksi)
    .toLocaleString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    let html = `
        <div class="grid md:grid-cols-4 gap-4 mb-6">

            <div>
                <p class="text-xs text-slate-400">
                    Tanggal
                </p>

                <p class="text-sm text-white">
                    ${tanggal}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-400">
                    Metode
                </p>

                <p class="text-sm text-white">
                    ${data.metode_pembayaran}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-400">
                    Staff
                </p>

                <p class="text-sm text-white">
                    ${data.staff.nama_lengkap}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-400">
                    Total
                </p>

                <p class="text-sm font-bold text-emerald-400">
                    Rp ${totalHarga.toLocaleString('id-ID')}
                </p>
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-slate-800 text-xs uppercase text-slate-500">

                        <th class="pb-3 text-left">
                            Obat
                        </th>

                        <th class="pb-3 text-left">
                            Jumlah
                        </th>

                        <th class="pb-3 text-left">
                            Expired
                        </th>

                        <th class="pb-3 text-left">
                            Total Harga
                        </th>

                    </tr>

                </thead>

                <tbody>
    `;

    data.detail_transaksi.forEach(item => {

        html += `

            <tr class="border-b border-slate-800/50">

                <td class="py-3 text-sm text-white">
                    ${item.detail_obat.obat.nama_obat}
                </td>

                <td class="py-3 text-sm text-white">
                    ${item.jumlah_obat}
                </td>

                <td class="py-3 text-sm text-slate-300">
                    ${item.detail_obat.tanggal_kadaluwarsa}
                </td>

                <td class="py-3 text-sm text-emerald-400">
                    Rp ${Number(item.total_harga).toLocaleString()}
                </td>

            </tr>
        `;
    });

    html += `
            </tbody>
        </table>
    </div>
    `;

    document
        .getElementById('detailContent')
        .innerHTML = html;

    document
        .getElementById('detailModal')
        .classList.remove('hidden');
}

function closeDetailModal()
{
    document
        .getElementById('detailModal')
        .classList.add('hidden');
}

</script>

@include('staff.modals.transaksi-detail')

@endsection