@extends('layouts.staff', ['isKasir' => true])

@section('title', 'Kasir Mode')

@section('content')

<div class="h-full flex flex-col">

    <!-- Header -->
    <div class="flex-1 flex flex-col pb-6">
        <div class="flex-1 overflow-y-auto">
            <div class="grid grid-cols-3 gap-6 h-full">

                <!-- LEFT: DAFTAR OBAT -->
                <div class="col-span-2 space-y-4">
                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-slate-800 bg-slate-900/40 text-[12px] font-bold uppercase tracking-wider text-slate-400">
                                        <th class="px-6 py-4">Nama Obat</th>
                                        <th class="px-6 py-4">Harga</th>
                                        <th class="px-6 py-4">Stok</th>
                                        <th class="px-6 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($obat as $item)
                                        <tr class="border-b border-slate-800/50 hover:bg-slate-800/30">
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ $item->nama_obat }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                Rp {{ number_format($item->harga) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ number_format($item->total_stok) }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <button
                                                    onclick="addToCart({{ $item->id }}, '{{ addslashes($item->nama_obat) }}', {{ $item->harga }}, {{ $item->total_stok }})"
                                                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold">
                                                    <i class="fa-solid fa-plus"></i> Tambah
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-8 text-slate-400">
                                                Tidak ada obat tersedia
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: KERANJANG -->
                <div class="space-y-6 flex flex-col">

                    <!-- CART ITEMS -->
                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6 flex-1 flex flex-col overflow-hidden">
                        <h3 class="text-lg font-bold text-white mb-4">Keranjang</h3>

                        <div id="cart-items" class="space-y-3 mb-4 flex-1 overflow-y-auto">
                            <!-- Cart items will be rendered here -->
                        </div>

                        <!-- TOTAL -->
                        <div class="border-t border-slate-700 pt-4">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-slate-300">Total:</span>
                                <span class="text-2xl font-bold text-white">
                                    Rp <span id="total-price">0</span>
                                </span>
                            </div>

                            <button
                                onclick="resetCart()"
                                class="w-full py-2 rounded-lg bg-slate-700 hover:bg-slate-600 text-white text-sm font-semibold">
                                <i class="fa-solid fa-trash"></i> Reset Keranjang
                            </button>
                        </div>
                    </div>

                    <!-- PAYMENT METHOD -->
                    <div class="bg-[#0f172a] border border-slate-800 rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Metode Pembayaran</h3>

                        <div class="relative mb-4">
                            <select
                                id="payment-method-select"
                                onchange="updatePaymentMethod(this.value)"
                                class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 text-white rounded-lg appearance-none cursor-pointer hover:border-slate-600 focus:border-blue-500 focus:outline-none">
                                <option value="cash">💰 Tunai (Cash)</option>
                                <option value="transfer">🏦 Transfer Bank</option>
                                <option value="qris">📱 QRIS</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-slate-400 pointer-events-none"></i>
                        </div>

                        <button
                            onclick="checkout()"
                            id="checkout-btn"
                            disabled
                            class="w-full py-3 rounded-lg bg-green-600 hover:bg-green-500 disabled:bg-slate-700 disabled:opacity-50 text-white font-bold">
                            <i class="fa-solid fa-check"></i> Checkout
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<script>
let cart = [];
let paymentMethod = 'cash';

function addToCart(id, name, price, stock) {
    const existingItem = cart.find(item => item.id_obat === id);

    if (existingItem) {
        existingItem.qty += 1;
    } else {
        cart.push({
            id_obat: id,
            nama_obat: name,
            harga: price,
            stok: stock,
            qty: 1
        });
    }

    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id_obat !== id);
    renderCart();
}

function updateQuantity(id, newQty) {
    const item = cart.find(item => item.id_obat === id);
    if (item) {
        const qty = parseInt(newQty) || 0;
        if (qty > 0 && qty <= item.stok) {
            item.qty = qty;
        } else if (qty > item.stok) {
            alert('Jumlah melebihi stok yang tersedia');
        }
        renderCart();
    }
}

function increaseQuantity(id) {
    const item = cart.find(item => item.id_obat === id);
    if (item && item.qty < item.stok) {
        item.qty += 1;
        renderCart();
    }
}

function decreaseQuantity(id) {
    const item = cart.find(item => item.id_obat === id);
    if (item && item.qty > 1) {
        item.qty -= 1;
        renderCart();
    }
}

function resetCart() {
    if (confirm('Yakin ingin mereset keranjang?')) {
        cart = [];
        renderCart();
    }
}

function updatePaymentMethod(method) {
    paymentMethod = method;
}

function renderCart() {
    const container = document.getElementById('cart-items');
    const checkoutBtn = document.getElementById('checkout-btn');

    if (cart.length === 0) {
        container.innerHTML = '<div class="text-center text-slate-400 py-4">Keranjang kosong</div>';
        checkoutBtn.disabled = true;
        document.getElementById('total-price').textContent = '0';
        return;
    }

    checkoutBtn.disabled = false;

    let total = 0;
    container.innerHTML = cart.map(item => {
        const itemTotal = item.harga * item.qty;
        total += itemTotal;

        return `
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-3">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-white">
                            ${item.nama_obat}
                        </div>
                        <div class="text-xs text-slate-400">
                            Rp ${item.harga.toLocaleString('id-ID')}
                        </div>
                    </div>
                    <button
                        onclick="removeFromCart(${item.id_obat})"
                        class="text-red-400 hover:text-red-300 text-sm">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    <button
                        onclick="decreaseQuantity(${item.id_obat})"
                        class="px-2 py-1 bg-slate-700 hover:bg-slate-600 rounded text-white text-sm">
                        -
                    </button>
                    <input
                        type="number"
                        value="${item.qty}"
                        min="1"
                        max="${item.stok}"
                        onchange="updateQuantity(${item.id_obat}, this.value)"
                        class="w-12 text-center bg-slate-700 text-white rounded text-sm py-1">
                    <button
                        onclick="increaseQuantity(${item.id_obat})"
                        class="px-2 py-1 bg-slate-700 hover:bg-slate-600 rounded text-white text-sm">
                        +
                    </button>
                    <span class="text-right flex-1 text-sm text-slate-300">
                        Rp ${itemTotal.toLocaleString('id-ID')}
                    </span>
                </div>
            </div>
        `;
    }).join('');

    document.getElementById('total-price').textContent = total.toLocaleString('id-ID');
}

function checkout() {
    if (cart.length === 0) {
        alert('Keranjang kosong!');
        return;
    }

    fetch("{{ route('staff.kasir.checkout') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            items: cart,
            payment_method: paymentMethod
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert(res.message);
            location.reload();
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(err => {
        alert('Terjadi kesalahan saat checkout');
        console.error(err);
    });
}

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    renderCart();
});
</script>

@endsection