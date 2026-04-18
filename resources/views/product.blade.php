<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TumblrVault – Sistem Manajemen Penjualan Tumbler</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

  {{-- ── NAVBAR ────────────────────────────────────────────── --}}
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
      <a class="navbar-brand-custom" href="{{ route('dashboard') }}">Tumblr<span>Vault</span></a>
      <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
          <li class="nav-item"><a class="nav-link nav-link-custom active" href="#beranda"><i class="bi bi-house me-1"></i>Beranda</a></li>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="#statistik"><i class="bi bi-bar-chart me-1"></i>Statistik</a></li>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="#produk"><i class="bi bi-box me-1"></i>Produk</a></li>
          <li class="nav-item ms-lg-1">
            <button class="btn-wishlist-nav" data-bs-toggle="modal" data-bs-target="#wishlistModal">
              <i class="bi bi-heart-fill"></i>
              <span class="wishlist-badge" id="wishlist-badge" style="display:none;">0</span>
            </button>
          </li>
        </ul>

        <div class="user-chip ms-lg-3">
          <div class="avatar">{{ strtoupper(substr(session('nama', 'U'), 0, 1)) }}</div>
          <span>{{ session('nama') }}</span>
          <span class="role-badge">{{ session('role') }}</span>
        </div>

        <button class="btn-logout ms-lg-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>

        <button id="btn-theme" title="Ganti Tema">
          <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
          <span id="theme-label">Mode Gelap</span>
        </button>
      </div>
    </div>
  </nav>

  {{-- Flash message sukses --}}
  @if(session('success'))
    <div class="toast-notif show" id="flashToast">
      <i class="bi bi-check-circle-fill me-2" style="color:#4a7a4e;"></i>
      {{ session('success') }}
    </div>
  @endif

  {{-- ── HERO SECTION ──────────────────────────────────────── --}}
  <section class="hero-section" id="beranda">
    <div class="container">
      <div class="row align-items-center min-vh-hero gy-4">
        <div class="col-lg-5">
          <p class="hero-eyebrow">Sistem Manajemen Tumbler</p>
          <h1 class="hero-title">Kelola Stok &amp;<br>Penjualan dengan<br>Mudah.</h1>
          <p class="hero-desc">Platform sederhana untuk mencatat produk, memantau stok, dan melihat penjualan tumbler Anda.</p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            <a href="#produk" class="btn btn-primary-custom"><i class="bi bi-eye me-2"></i>Lihat Produk</a>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="hero-img-container">
            <img src="{{ asset('assets/bg.jpg') }}" alt="Hero Product" class="hero-product-img" onerror="this.parentElement.classList.add('hero-img-fallback');" />
            <div class="hero-label label-a"><i class="bi bi-check-circle-fill text-success me-1"></i>Vakum Double Wall</div>
            <div class="hero-label label-b"><i class="bi bi-droplet-fill me-1" style="color:var(--dusty)"></i>Anti Bocor</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ── STATS SECTION ─────────────────────────────────────── --}}
  <section class="stats-section" id="statistik">
    <div class="container">
      <div class="text-center mb-5">
        <p class="section-label">Ringkasan</p>
        <h2 class="section-title">Statistik Penjualan</h2>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-sm-6 col-md-4">
          <div class="stat-card">
            <div class="stat-icon-wrap"><i class="bi bi-box-seam"></i></div>
            <div class="stat-val">128</div>
            <div class="stat-label">Total Produk</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ── PRODUCT SECTION ───────────────────────────────────── --}}
  <section class="product-section" id="produk">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Daftar Koleksi Tumbler</h3>
                <p class="text-muted small">Kelola semua inventaris produk Anda di sini</p>
            </div>
            <button type="button" class="btn btn-primary-custom shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Tumbler
            </button>
        </div>

        <div class="slider-wrapper">
            <div class="slider-track" id="sliderTrack">
                {{-- Loop Produk dari Database --}}
                @foreach($products as $p)
                <div class="product-slide-card" data-id="{{ $p->product_id }}">
                    <div class="pcard-img-wrap">
                        <img src="{{ asset('assets/stanley.jpg') }}" class="pcard-img" />
                        <button class="btn-wishlist-card"><i class="bi bi-heart"></i></button>
                    </div>
                    <div class="pcard-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge-stock {{ $p->product_stock > 5 ? 'badge-in' : 'badge-low' }}">
                                {{ $p->product_stock > 5 ? 'Tersedia' : 'Stok Tipis' }}
                            </span>
                            <span class="pcard-sku">SKU-{{ $p->product_id }}</span>
                        </div>
                        <h5 class="pcard-name">{{ $p->product_name }}</h5>
                        <p class="pcard-category"><i class="bi bi-layers me-1"></i>{{ $p->category->category_name }}</p>
                        <p class="pcard-brand"><i class="bi bi-tag me-1"></i>{{ $p->brand->nama_brand }}</p>
                        <p class="stok-text"><i class="bi bi-box-seam me-1"></i>Stok: {{ $p->product_stock }}</p>
                        <hr class="pcard-divider" />
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="pcard-price">Rp {{ number_format($p->product_price, 0, ',', '.') }}</span>
                            <button class="btn-detail-view">Detail</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button id="sliderPrev" class="slider-nav-btn slider-nav-prev" title="Produk Sebelumnya">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button id="sliderNext" class="slider-nav-btn slider-nav-next" title="Produk Berikutnya">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>
  </section>

  {{-- ── FOOTER ────────────────────────────────────────────── --}}
  <footer class="footer-custom">
    {{-- ... Isi Footer ... --}}
  </footer>

  {{-- ── MODALS (Taruh di paling bawah sebelum script) ───────── --}}

  {{-- 1. Modal Tambah Produk --}}
  <div class="modal fade" id="tambahProdukModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-custom border-0 shadow">
        <div class="modal-header modal-header-custom">
          <h1 class="modal-title fs-5 fw-bold">
            <i class="bi bi-plus-circle-fill me-2" style="color:var(--dusty)"></i>Tambah Produk Tumbler Baru
          </h1>
          <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <form action="{{ route('products.store') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <div class="mb-3">
              <label for="product_name" class="form-label fw-bold">Nama Tumbler</label>
              <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Masukkan nama produk..." required>
            </div>

            <div class="mb-3">
              <label for="category_id" class="form-label fw-bold">Kategori</label>
              <select class="form-select" id="category_id" name="category_id" required>
                <option value="" selected disabled>Pilih Kategori...</option>
                @foreach ($category as $cat)
                  <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="brand_id" class="form-label fw-bold">Brand</label>
              <select class="form-select" id="brand_id" name="brand_id" required>
                <option value="" selected disabled>Pilih Brand...</option>
                @foreach ($brands as $brand)
                  <option value="{{ $brand->brand_id }}">{{ $brand->nama_brand }}</option>
                @endforeach
              </select>
            </div>

            <div class="row">
              <div class="col-6 mb-3">
                <label for="product_price" class="form-label fw-bold">Harga Satuan</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0">Rp</span>
                  <input type="number" class="form-control border-start-0" id="product_price" name="product_price" placeholder="0" required>
                </div>
              </div>
              <div class="col-6 mb-3">
                <label for="product_stock" class="form-label fw-bold">Stok Awal</label>
                <input type="number" class="form-control" id="product_stock" name="product_stock" placeholder="0" required>
              </div>
            </div>
          </div>
          <div class="modal-footer modal-footer-custom bg-light border-0">
            <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary-custom px-4">
              <i class="bi bi-check-circle me-1"></i> Simpan Produk
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- 2. Modal Wishlist/Favorit --}}
  <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 shadow">
        <div class="modal-header modal-header-custom bg-light border-0 pb-3">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-heart-fill me-2" style="color:#e74c3c;"></i>Produk Favoritan Saya
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="wishlistContent" style="min-height: 200px;">
          <div class="text-center text-muted py-4">
            <i class="bi bi-heart" style="font-size: 2rem; opacity: 0.3;"></i>
            <p class="mt-2">Belum ada produk favorit</p>
          </div>
        </div>
        <div class="modal-footer bg-light border-top">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  {{-- 3. Modal Logout --}}
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-arrow-right text-danger display-4"></i>
                </div>
                <h5>Konfirmasi Logout</h5>
                <p class="text-muted small">Yakin ingin mengakhiri sesi, <strong>{{ session('nama') }}</strong>?</p>
                <div class="d-flex gap-2 mt-4">
                    <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" class="flex-grow-1">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">Ya, Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>

  {{-- ── SCRIPTS ────────────────────────────────────────────── --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  <script>
    const toast = document.getElementById('flashToast');
    if (toast) {
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 500);
      }, 3000);
    }

    const STORAGE_KEY = 'tumblr_favorites';
    const productData = @json($products);

    function getFavorites() {
      const fav = localStorage.getItem(STORAGE_KEY);
      return fav ? JSON.parse(fav) : {};
    }

    function saveFavorites(favorites) {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(favorites));
      updateFavoriteBadge();
    }

    function updateFavoriteBadge() {
      const favorites = getFavorites();
      const count = Object.keys(favorites).length;
      const badge = document.getElementById('wishlist-badge');
      if (count > 0) {
        badge.textContent = count;
        badge.style.display = 'inline-flex';
      } else {
        badge.style.display = 'none';
      }
    }

    function updateWishlistModal() {
      const favorites = getFavorites();
      const content = document.getElementById('wishlistContent');
      
      if (Object.keys(favorites).length === 0) {
        content.innerHTML = `
          <div class="text-center text-muted py-4">
            <i class="bi bi-heart" style="font-size: 2rem; opacity: 0.3;"></i>
            <p class="mt-2">Belum ada produk favorit</p>
          </div>
        `;
        return;
      }

      let html = '';
      Object.entries(favorites).forEach(([productId, product]) => {
        html += `
          <div class="favorite-item" data-id="${productId}">
            <div class="favorite-img">
              <img src="{{ asset('assets/stanley.jpg') }}" alt="${product.name}" />
            </div>
            <div class="favorite-info">
              <div class="favorite-name">${product.name}</div>
              <div class="favorite-detail"><strong>Kategori:</strong> ${product.category}</div>
              <div class="favorite-detail"><strong>Brand:</strong> ${product.brand}</div>
              <div class="favorite-price">Rp ${Number(product.price).toLocaleString('id-ID')}</div>
            </div>
            <button class="btn btn-sm btn-danger btn-remove-fav" type="button">
              <i class="bi bi-trash"></i> Hapus
            </button>
          </div>
        `;
      });
      content.innerHTML = html;

      // Event listeners untuk tombol hapus
      content.querySelectorAll('.btn-remove-fav').forEach(btn => {
        btn.addEventListener('click', function() {
          const productId = this.closest('.favorite-item').dataset.id;
          removeFavorite(productId);
        });
      });
    }

    function toggleFavorite(productId, product) {
      const favorites = getFavorites();
      if (favorites[productId]) {
        delete favorites[productId];
      } else {
        favorites[productId] = {
          name: product.product_name,
          category: product.category.category_name,
          brand: product.brand.nama_brand,
          price: product.product_price
        };
      }
      saveFavorites(favorites);
    }

    function removeFavorite(productId) {
      const favorites = getFavorites();
      delete favorites[productId];
      saveFavorites(favorites);
      updateWishlistModal();
    }

    // Initialize wishlist on page load
    document.addEventListener('DOMContentLoaded', () => {
      updateFavoriteBadge();

      // Event listener untuk semua tombol wishlist di product cards
      document.querySelectorAll('.btn-wishlist-card').forEach(btn => {
        const productId = btn.closest('.product-slide-card').dataset.id;
        const product = productData.find(p => p.product_id == productId);
        
        btn.addEventListener('click', () => {
          toggleFavorite(productId, product);
          const favorites = getFavorites();
          if (favorites[productId]) {
            btn.classList.add('active');
            btn.innerHTML = '<i class="bi bi-heart-fill"></i>';
          } else {
            btn.classList.remove('active');
            btn.innerHTML = '<i class="bi bi-heart"></i>';
          }
        });

        // Restore state on load
        const favorites = getFavorites();
        if (favorites[productId]) {
          btn.classList.add('active');
          btn.innerHTML = '<i class="bi bi-heart-fill"></i>';
        }
      });

      // Event listener untuk modal wishlist
      const wishlistModal = document.getElementById('wishlistModal');
      if (wishlistModal) {
        wishlistModal.addEventListener('show.bs.modal', () => {
          updateWishlistModal();
        });
      }

      // ── SLIDER NAVIGATION ──────────────────────────────
      const sliderTrack = document.getElementById('sliderTrack');
      const sliderPrev = document.getElementById('sliderPrev');
      const sliderNext = document.getElementById('sliderNext');
      let scrollPosition = 0;
      const cardWidth = 280; // Approximate card width + gap
      const visibleCards = Math.floor(window.innerWidth / cardWidth);

      function updateSliderButtons() {
        const maxScroll = sliderTrack.scrollWidth - sliderTrack.parentElement.clientWidth;
        sliderPrev.disabled = scrollPosition <= 0;
        sliderNext.disabled = scrollPosition >= maxScroll - 10;
      }

      sliderPrev.addEventListener('click', () => {
        scrollPosition = Math.max(0, scrollPosition - (cardWidth + 24));
        sliderTrack.style.transform = `translateX(-${scrollPosition}px)`;
        updateSliderButtons();
      });

      sliderNext.addEventListener('click', () => {
        const maxScroll = sliderTrack.scrollWidth - sliderTrack.parentElement.clientWidth;
        scrollPosition = Math.min(maxScroll, scrollPosition + (cardWidth + 24));
        sliderTrack.style.transform = `translateX(-${scrollPosition}px)`;
        updateSliderButtons();
      });

      // Add transition effect
      sliderTrack.style.transition = 'transform 0.4s ease';

      // Initialize buttons state
      updateSliderButtons();

      // Handle window resize
      window.addEventListener('resize', updateSliderButtons);
    });
  </script>

</body>
</html>