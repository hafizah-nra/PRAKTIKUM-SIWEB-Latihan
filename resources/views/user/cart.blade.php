@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="hero-section">
    <h1>Keranjang Belanja</h1>
    <p>Periksa dan selesaikan pembelian Anda</p>
</div>

<!-- Alerts -->
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-error">
        {{ $message }}
    </div>
@endif

@if (count($cart) > 0)
    <div class="cart-layout">
        <!-- Cart Items -->
        <div class="table-container">
            <h2 style="margin-bottom: 1.5rem;">Produk di Keranjang ({{ count($cart) }} item)</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['name'] }}</strong>
                                <br>
                                <small class="product-description">{{ Str::limit($item['description'], 50) }}</small>
                            </td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="quantity-form">
                                    @csrf
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ $item['quantity'] }}" 
                                        min="1"
                                        max="999"
                                        class="quantity-input-cart"
                                        onchange="this.form.submit()"
                                    >
                                </form>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove-cart">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #ddd;">
                <a href="{{ route('user.landing') }}" class="add-btn" style="display: inline-block; margin-right: 1rem;">
                    ← Lanjut Belanja
                </a>
                <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;" onsubmit="return confirm('Kosongkan seluruh keranjang?');">
                    @csrf
                    <button type="submit" class="btn-clear-cart">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="cart-summary-box">
            <h3>Ringkasan Pesanan</h3>
            
            <div class="summary-item">
                <span>Subtotal:</span>
                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>

            <div class="summary-item">
                <span>Pajak (10%):</span>
                <strong>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</strong>
            </div>

            <div class="summary-item" style="font-size: 1.2rem; padding-top: 1rem; border-top: 1px solid #ddd; margin-top: 1rem;">
                <span>Total:</span>
                <strong style="color: var(--color-tangelo);">Rp {{ number_format($total * 1.1, 0, ',', '.') }}</strong>
            </div>

            <button type="button" class="btn-checkout" onclick="alert('Fitur checkout akan segera hadir!')">
                Lanjutkan ke Pembayaran
            </button>

            <div class="summary-info">
                <p><strong>Informasi Pengiriman:</strong></p>
                <ul>
                    <li>Gratis ongkir untuk pembelian > Rp 100.000</li>
                    <li>Pengiriman dalam 1-3 hari kerja</li>
                    <li>Garansi uang kembali 100%</li>
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="empty-state" style="margin-top: 3rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">🛒</div>
        <h2>Keranjang Anda Kosong</h2>
        <p style="margin-bottom: 2rem;">Mulai berbelanja sekarang dan temukan produk favorit Anda.</p>
        <a href="{{ route('user.landing') }}" class="add-btn">
            Kembali ke Toko
        </a>
    </div>
@endif
@endsection
