@extends('layouts.app')

@section('title', 'Kelola Produk - Admin')

@section('content')
<div class="hero-section">
    <h1>Kelola Produk</h1>
    <p>Kelola semua produk di toko Anda</p>
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

<!-- Add Product Button -->
<div class="add-btn-wrapper">
    <a href="{{ route('admin.products.create') }}" class="add-btn">
        + Tambah Produk Baru
    </a>
</div>

<!-- Products Table -->
<div class="table-container">
    @if ($products->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>SKU</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span style="color: #999; font-size: 0.9rem;">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small class="product-description">{{ Str::limit($product->description, 50) }}</small>
                        </td>
                        <td>{{ $product->sku ?? '-' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'low-stock' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <div class="category-tags">
                                @if ($product->categories->count() > 0)
                                    @foreach ($product->categories as $category)
                                        <span class="category-tag">{{ $category->name }}</span>
                                    @endforeach
                                @else
                                    <span class="category-no-data">-</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    @else
        <div class="empty-state">
            <p>Belum ada produk.</p>
            <a href="{{ route('admin.products.create') }}" class="add-btn">
                Buat Produk Pertama
            </a>
        </div>
    @endif
</div>
@endsection
