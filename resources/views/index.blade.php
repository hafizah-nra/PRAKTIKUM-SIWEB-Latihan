{{-- code untuk file index.blade.php --}}
@extends('layouts.main')
@include('modal.wishlist')

@section('content')
<div class="hero text-center text-white d-flex align-items-center">
        <div class="container">
            <h1>Sistem Manajemen Sepatu</h1>
            <p>Kelola Data Sepatu Dengan Mudah</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5>Total Produk</h5>
                        <h2 id="total-produk">3</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5>Stok Tersedia</h5>
                        <h2 id="total-stok">27</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5>Kategori</h5>
                        <h2>3</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <h3 class="mb-4">Daftar Sepatu</h3>
            <a href="{{ route('products')}}" class="btn btn-primary me-2">Lihat Semua Produk</a>
        </div>
        <div class="row" id="container-barang">

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('assets/NIKE_P_6000.jpg') }}" class="card-img-top" alt="Sepatu" />
                    <div class="card-body">
                        <h5 class="card-title">Nike P-6000</h5>
                        <p class="card-text harga-text">Harga: Rp 1429000</p>
                        <p class="card-text stok-text">Stok: 10</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                            <button class="btn btn-outline-danger btn-wishlist w-50">❤️ Wishlist</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('assets/AIR_FORCE_1.jpg') }}" class="card-img-top" alt="Sepatu" />
                    <div class="card-body">
                        <h5 class="card-title">Nike Air Force 1</h5>
                        <p class="card-text harga-text">Harga: Rp 1529000</p>
                        <p class="card-text stok-text">Stok: 7</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                            <button class="btn btn-outline-danger btn-wishlist w-50">❤️ Wishlist</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('assets/AIR_JORDAN_1_LOW.jpg') }}" class="card-img-top" alt="Sepatu" />
                    <div class="card-body">
                        <h5 class="card-title">Nike Air Jordan 1 Low</h5>
                        <p class="card-text harga-text">Harga: Rp 1729000</p>
                        <p class="card-text stok-text">Stok: 10</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                            <button class="btn btn-outline-danger btn-wishlist w-50">❤️ Wishlist</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
{{-- batas code index.blade.php --}}


{{-- batas code product.blade.php --}}