@extends('layouts.main')

@section('title', 'Dashboard – TumblrVault')

@section('content')
  <section class="hero-section" id="beranda" style="padding-top: 120px;">
    <div class="container">
      <div class="row align-items-center min-vh-hero gy-4">
        <div class="col-lg-5">
          <p class="hero-eyebrow">Selamat Datang, {{ Auth::user()->name }}!</p>
          <h1 class="hero-title">
            Kelola Stok &amp;<br>Penjualan dengan<br>Mudah.
          </h1>
          <p class="hero-desc">
            Platform sederhana untuk mencatat produk, memantau stok, dan melihat penjualan tumbler Anda. 
            Saat ini Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>.
          </p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            @if(Auth::user()->isAdmin())
              <a href="{{ route('products.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle me-2"></i>Tambah Produk
              </a>
            @endif
            <a href="{{ route('products.index') }}" class="btn btn-outline-custom">
              <i class="bi bi-eye me-2"></i>Lihat Produk
            </a>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="hero-img-container">
            <img src="{{ asset('assets/bg.jpg') }}"
                 onerror="this.onerror=null;this.src='';this.parentElement.classList.add('hero-img-fallback');"
                 alt="Tumbler produk unggulan"
                 class="hero-product-img" />
            <div class="hero-label label-a">
              <i class="bi bi-check-circle-fill text-success me-1"></i>Vakum Double Wall
            </div>
            <div class="hero-label label-b">
              <i class="bi bi-droplet-fill me-1" style="color:var(--dusty)"></i>Anti Bocor
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ── STATISTIK ─────────────────────────────────────────── --}}
  <section class="stats-section" id="statistik">
    <div class="container">
      <div class="text-center mb-5">
        <p class="section-label">Ringkasan</p>
        <h2 class="section-title">Statistik Inventaris</h2>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-sm-6 col-md-4">
          <div class="stat-card">
            <div class="stat-icon-wrap"><i class="bi bi-box-seam"></i></div>
            <div class="stat-val">{{ $stats['total_products'] }}</div>
            <div class="stat-label">Total Jenis Produk</div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="stat-card">
            <div class="stat-icon-wrap" style="background:rgba(122,158,126,0.15);">
              <i class="bi bi-check-circle" style="color:#4a7a4e"></i>
            </div>
            <div class="stat-val">{{ $stats['total_stock'] }}</div>
            <div class="stat-label">Total Stok Tersedia</div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4">
          <div class="stat-card">
            <div class="stat-icon-wrap" style="background:rgba(102,78,68,0.1);">
              <i class="bi bi-people" style="color:var(--dusty)"></i>
            </div>
            <div class="stat-val" style="font-size:1.6rem; text-transform:capitalize;">{{ Auth::user()->role }}</div>
            <div class="stat-label">Hak Akses Anda</div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
