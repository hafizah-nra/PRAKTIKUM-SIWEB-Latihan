{{-- code untuk file product.blade.php --}}
@extends('layouts.main')
@include('modal.wishlist')
@include('modal.createProduct')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <h3 class="mb-4">Daftar Sepatu</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                Tambah Produk
            </button>
        </div>
        <div class="row" id="container-barang">
            @foreach ($products as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <img src="{{ asset('storage/' . $item->product_image) }}" class="card-img-top mb-top" alt="{{ $item->product_name }}"
                                style="height: 250px; object-fit: cover;">
                            <h5 class="card-title">{{ $item->product_name }}</h5>
                            <p class="card-text harga-text text-danger mb-1">
                                Harga: Rp {{ number_format($item->product_price, 0, ',', '.') }}
                            </p>
                            <p class="card-text stok-text mb-3">Stok: {{ $item->product_stock }}</p>

                            {{-- Tombol Update dan Hapus --}}
                            <div class="d-flex gap-2 mt-auto">
                                <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#editProdukModal{{ $item->product_id }}" >Update</button>
                                
                                <form action="{{ route('products.destroy', $item->product_id ) }}" method="POST" class="w-100 m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Edit Produk -->
    @foreach ($products as $item)
    <div class="modal fade" id="editProdukModal{{ $item->product_id }}" tabindex="-1" aria-labelledby="editProdukModalLabel{{ $item->product_id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdukModalLabel{{ $item->product_id }}">Edit Produk: {{ $item->product_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.update', $item->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" value="{{ $item->product_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" name="category_id" required>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->category_id }}" {{ $item->category_id == $cat->category_id ? 'selected' : '' }}>
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" name="product_price" value="{{ $item->product_price }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok Produk</label>
                            <input type="number" class="form-control" name="product_stock" value="{{ $item->product_stock }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar Produk (Opsional)</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $item->product_image) }}" alt="Current Image" class="img-thumbnail" style="width: 100px;">
                            </div>
                            <input type="file" class="form-control" name="product_image">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
{{-- batas code product.blade.php --}}