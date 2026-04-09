@extends('layouts.app')

@section('title', 'Edit Produk - Admin')

@section('content')
<div class="hero-section">
    <h1>Edit Produk</h1>
    <p>Perbarui informasi produk "{{ $product->name }}"</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div class="form-group">
            <label for="name">Nama Produk <span class="required-field">*</span></label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $product->name) }}" 
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
            >{{ old('description', $product->description) }}</textarea>
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
                value="{{ old('sku', $product->sku) }}" 
                placeholder="Masukkan SKU produk"
            >
            @error('sku')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Foto Produk -->
        <div class="form-group">
            <label for="image">Foto Produk</label>
            @if($product->image)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; height: auto; border-radius: 8px;">
                    <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #666;">Foto saat ini</p>
                </div>
            @endif
            <input 
                type="file" 
                id="image" 
                name="image" 
                accept="image/jpeg,image/png,image/jpg,image/gif"
            >
            <small style="display: block; margin-top: 0.5rem; color: #666;">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin ubah foto.</small>
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
                value="{{ old('price', $product->price) }}" 
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
                value="{{ old('stock', $product->stock) }}" 
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
                                {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}
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
                Perbarui Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
