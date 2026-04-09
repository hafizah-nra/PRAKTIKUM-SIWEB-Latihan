@extends('layouts.app')

@section('title', 'Tambah Produk - Admin')

@section('content')
<div class="hero-section">
    <h1>Tambah Produk Baru</h1>
    <p>Isi form di bawah untuk menambahkan produk baru ke toko Anda</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="form-group">
            <label for="name">Nama Produk <span class="required-field">*</span></label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                placeholder="Masukkan nama produk"
                required
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea 
                id="description" 
                name="description" 
                placeholder="Masukkan deskripsi produk"
                rows="4"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- SKU -->
        <div class="form-group">
            <label for="sku">SKU</label>
            <input 
                type="text" 
                id="sku" 
                name="sku" 
                value="{{ old('sku') }}" 
                placeholder="Masukkan SKU produk"
            >
            @error('sku')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto Produk -->
        <div class="form-group">
            <label for="image">Foto Produk</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                accept="image/jpeg,image/png,image/jpg,image/gif"
            >
            <small style="display: block; margin-top: 0.5rem; color: #666;">Format: JPG, PNG, GIF. Maksimal 2MB</small>
            @error('image')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga -->
        <div class="form-group">
            <label for="price">Harga <span class="required-field">*</span></label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                value="{{ old('price') }}" 
                placeholder="Masukkan harga produk"
                step="0.01"
                min="0"
                required
            >
            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stok -->
        <div class="form-group">
            <label for="stock">Stok <span class="required-field">*</span></label>
            <input 
                type="number" 
                id="stock" 
                name="stock" 
                value="{{ old('stock') }}" 
                placeholder="Masukkan jumlah stok"
                min="0"
                required
            >
            @error('stock')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="form-group">
            <label for="categories">Kategori (Pilih satu atau lebih)</label>
            <div class="categories-box">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <div class="category-checkbox-item">
                            <input 
                                type="checkbox" 
                                id="category_{{ $category->id }}" 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                class="category-checkbox"
                            >
                            <label for="category_{{ $category->id }}" class="category-checkbox-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="category-no-data">Belum ada kategori. Silakan buat kategori terlebih dahulu.</p>
                @endif
            </div>
            @error('categories')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="button-group">
            <button type="submit" class="btn-save">
                Simpan Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
