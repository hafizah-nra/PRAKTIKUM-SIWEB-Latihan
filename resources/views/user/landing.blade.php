@extends('layouts.app')

@section('title', 'Toko Online - Belanja Produk')

@section('content')
<div class="hero-section">
    <h1>Selamat Datang di Toko Online</h1>
    <p>Temukan ribuan produk berkualitas dengan harga terbaik</p>
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

<!-- Category Filter -->
<div class="category-filter-section">
    <h3 style="margin-bottom: 1rem; color: var(--color-brown);">Filter Kategori</h3>
    <div class="category-filter-bar">
        <a href="{{ route('user.landing') }}" class="filter-btn {{ !isset($selectedCategory) ? 'active' : '' }}">
            Semua Produk
        </a>
        @foreach ($categories as $category)
            <a href="{{ route('user.category', $category->id) }}" class="filter-btn {{ isset($selectedCategory) && $selectedCategory->id == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<!-- Products Grid -->
<h2 style="margin-top: 3rem; margin-bottom: 2rem; color: var(--color-brown);">
    {{ isset($selectedCategory) ? 'Produk - ' . $selectedCategory->name : 'Semua Produk' }}
</h2>

@if ($products->count() > 0)
    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <div class="product-card-header">
                    <h3>{{ $product->name }}</h3>
                </div>

                <div class="product-card-image">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 4px;">
                    @else
                        <div style="width: 100%; height: 250px; background-color: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999;">
                            <span>Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                <div class="product-card-body">
                    <p class="description">{{ Str::limit($product->description, 60) }}</p>
                    
                    <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    
                    <div class="stock-info">
                        <span class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'low-stock' }}">
                            Stok: {{ $product->stock }}
                        </span>
                    </div>

                    <div class="product-categories">
                        <strong>Kategori:</strong>
                        <div class="category-tags">
                            @if ($product->categories->count() > 0)
                                @foreach ($product->categories as $category)
                                    <span class="category-tag">{{ $category->name }}</span>
                                @endforeach
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="product-card-footer">
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                            @csrf
                            <div class="quantity-input-group">
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $product->stock }}"
                                    class="quantity-input"
                                >
                            </div>
                            <button type="submit" class="btn-add-cart">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="btn-out-of-stock">
                            Produk Habis
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <p>Tidak ada produk yang sesuai dengan filter Anda.</p>
        <a href="{{ route('user.landing') }}" class="add-btn">
            Lihat Semua Produk
        </a>
    </div>
@endif
@endsection
