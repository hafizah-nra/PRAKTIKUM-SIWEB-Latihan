<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk – TumblrVault</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
      <a class="navbar-brand-custom" href="{{ route('dashboard') }}">Tumblr<span>Vault</span></a>
      <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
          <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('dashboard') }}"><i class="bi bi-house me-1"></i>Beranda</a></li>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('dashboard') }}#statistik"><i class="bi bi-bar-chart me-1"></i>Statistik</a></li>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('dashboard') }}#produk"><i class="bi bi-box me-1"></i>Produk</a></li>
          <li class="nav-item ms-lg-2">
            <a class="btn btn-primary-custom active" href="{{ route('produk.tambah') }}">
              <i class="bi bi-plus me-1"></i>Tambah Produk
            </a>
          </li>
        </ul>

        <div class="user-chip ms-lg-3">
          <div class="avatar">{{ strtoupper(substr(session('nama', 'U'), 0, 1)) }}</div>
          <span>{{ session('nama') }}</span>
          <span class="role-badge">{{ session('role') }}</span>
        </div>

        <button class="btn-logout ms-lg-2"
          data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-right"></i>
          Logout
        </button>

        <button id="btn-theme" title="Ganti Tema">
          <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
          <span id="theme-label">Mode Gelap</span>
        </button>
      </div>
    </div>
  </nav>

  <div class="tambah-header">
    <div class="container">
      <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ route('dashboard') }}" class="back-btn">
          <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-cur">Tambah Produk</span>
      </div>
      <h1 class="tambah-title">Tambah Produk Baru</h1>
      <p class="tambah-desc">Isi data produk tumbler yang akan ditambahkan ke inventori</p>
    </div>
  </div>

  <section class="tambah-body">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="form-card">

            {{-- Tampilkan error validasi --}}
            @if($errors->any())
              <div class="alert mb-4 py-2 px-3"
                   style="border-radius:10px;font-size:0.84rem;border:none;
                          background:rgba(201,123,90,0.12);color:#a05a2c;
                          border-left:4px solid #c97b5a;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <ul class="mb-0 ps-3">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- Form POST ke route produk.simpan --}}
            <form method="POST" action="{{ route('produk.simpan') }}"
                  enctype="multipart/form-data" id="productForm" novalidate>
              @csrf

              <div class="form-section-title"><i class="bi bi-image me-2"></i>Foto Produk</div>
              <div class="mb-4">
                <div class="upload-area" id="uploadArea">
                  <input type="file" id="fotoInput" name="foto"
                    accept="image/jpeg,image/png,image/webp" class="upload-input" />
                  <div class="upload-placeholder" id="uploadPlaceholder">
                    <i class="bi bi-cloud-arrow-up upload-icon"></i>
                    <p class="upload-text">Klik atau seret foto ke sini</p>
                    <p class="upload-hint">JPG, PNG, WebP — maks. 5MB</p>
                  </div>
                  <div class="upload-preview" id="uploadPreview" style="display:none;">
                    <img id="previewImg" src="" alt="Preview" />
                    <button type="button" class="upload-remove" id="removeImg">
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </div>
                </div>
              </div>

              <hr class="form-divider" />

              <div class="form-section-title"><i class="bi bi-info-circle me-2"></i>Informasi Produk</div>

              <div class="row g-3 mb-3">
                <div class="col-md-8">
                  <label class="form-label-custom" for="nama">
                    Nama Produk <span class="required-star">*</span>
                  </label>
                  <input type="text" id="nama" name="nama"
                    class="form-control form-control-custom @error('nama') is-invalid @enderror"
                    placeholder="Contoh: AquaCore Pro 750ml"
                    value="{{ old('nama') }}" required />
                  @error('nama')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <label class="form-label-custom" for="sku">
                    Kode SKU <span class="required-star">*</span>
                  </label>
                  <input type="text" id="sku" name="sku"
                    class="form-control form-control-custom @error('sku') is-invalid @enderror"
                    placeholder="TBL-00X"
                    value="{{ old('sku') }}" required />
                  @error('sku')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label-custom" for="kategori">
                    Kategori <span class="required-star">*</span>
                  </label>
                  <select id="kategori" name="kategori"
                    class="form-control form-control-custom @error('kategori') is-invalid @enderror"
                    required>
                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih kategori...</option>
                    @foreach([
                      'stainless'   => 'Stainless Steel',
                      'double-wall' => 'Double Wall',
                      'keramik'     => 'Keramik',
                      'bambu'       => 'Bambu',
                      'plastik'     => 'Plastik BPA-Free',
                      'titanium'    => 'Titanium',
                      'borosilikat' => 'Borosilikat / Kaca',
                    ] as $val => $label)
                      <option value="{{ $val }}" {{ old('kategori') == $val ? 'selected' : '' }}>
                        {{ $label }}
                      </option>
                    @endforeach
                  </select>
                  @error('kategori')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label-custom" for="kapasitas">
                    Kapasitas (ml) <span class="required-star">*</span>
                  </label>
                  <input type="number" id="kapasitas" name="kapasitas"
                    class="form-control form-control-custom @error('kapasitas') is-invalid @enderror"
                    placeholder="Contoh: 750" min="100" max="3000"
                    value="{{ old('kapasitas') }}" required />
                  @error('kapasitas')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="form-label-custom" for="harga">
                    Harga Jual (Rp) <span class="required-star">*</span>
                  </label>
                  <div class="input-prefix-wrap">
                    <span class="input-prefix">Rp</span>
                    <input type="number" id="harga" name="harga"
                      class="form-control form-control-custom with-prefix @error('harga') is-invalid @enderror"
                      placeholder="185000" min="1000"
                      value="{{ old('harga') }}" required />
                  </div>
                  @error('harga')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label-custom" for="stok">
                    Jumlah Stok <span class="required-star">*</span>
                  </label>
                  <input type="number" id="stok" name="stok"
                    class="form-control form-control-custom @error('stok') is-invalid @enderror"
                    placeholder="Contoh: 50" min="0"
                    value="{{ old('stok') }}" required />
                  @error('stok')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <hr class="form-divider" />

              <div class="form-section-title"><i class="bi bi-list-ul me-2"></i>Detail Produk</div>
              <div class="mb-4">
                <label class="form-label-custom" for="deskripsi">Deskripsi Produk</label>
                <textarea id="deskripsi" name="deskripsi"
                  class="form-control form-control-custom"
                  rows="5"
                  placeholder="Tulis deskripsi produk, keunggulan, bahan, cara penggunaan, dll...">{{ old('deskripsi') }}</textarea>
              </div>

              <hr class="form-divider" />

              <div class="d-flex gap-3 justify-content-between flex-wrap">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-custom">
                  <i class="bi bi-x-lg me-2"></i>Batal
                </a>
                <div class="d-flex gap-2">
                  <button type="reset" class="btn btn-outline-custom">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                  </button>
                  <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check2-circle me-2"></i>Simpan Produk
                  </button>
                </div>
              </div>

            </form>

            {{-- Pesan sukses dari session --}}
            @if(session('success'))
              <div class="success-msg mt-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <a href="{{ route('dashboard') }}" class="ms-2"
                   style="color:#4a7a4e;font-weight:600;text-decoration:underline;">
                  Lihat Inventori →
                </a>
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Modal Logout --}}
  <div class="modal fade modal-logout" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title d-flex align-items-center gap-2">
            <span style="width:34px;height:34px;border-radius:50%;background:rgba(102,78,68,0.1);display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-box-arrow-right" style="color:#664E44;font-size:0.9rem;"></i>
            </span>
            Konfirmasi Logout
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="padding:16px 24px 8px;">
          <p style="margin:0;font-size:0.88rem;color:rgba(58,44,38,0.7);">
            Hei, <strong style="color:#664E44;">{{ session('nama') }}</strong>! Yakin ingin keluar?
          </p>
        </div>
        <div class="modal-footer border-0 pt-0 gap-2">
          <button type="button" class="btn-cancel-logout" data-bs-dismiss="modal">Batal</button>
          <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn-confirm-logout">
              <i class="bi bi-box-arrow-right me-1"></i>Ya, Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Footer --}}
  <footer class="footer-custom">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4">
          <div class="footer-brand">Tumblr<span>Vault</span></div>
          <p class="footer-desc">Sistem manajemen penjualan tumbler yang sederhana dan efisien.</p>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="footer-heading">Navigasi</div>
          <a href="{{ route('dashboard') }}" class="footer-link">Beranda</a>
          <a href="{{ route('dashboard') }}#statistik" class="footer-link">Statistik</a>
          <a href="{{ route('dashboard') }}#produk" class="footer-link">Produk</a>
          <a href="{{ route('produk.tambah') }}" class="footer-link">Tambah Produk</a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
          <div class="footer-heading">Kategori</div>
          <a href="#" class="footer-link">Stainless Steel</a>
          <a href="#" class="footer-link">Double Wall</a>
          <a href="#" class="footer-link">Keramik</a>
          <a href="#" class="footer-link">Bambu &amp; Eco</a>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="footer-heading">Kontak</div>
          <a href="#" class="footer-link"><i class="bi bi-envelope me-2"></i>admin@tumblrvault.id</a>
          <a href="#" class="footer-link"><i class="bi bi-telephone me-2"></i>+62 812 3456 7890</a>
          <a href="#" class="footer-link"><i class="bi bi-geo-alt me-2"></i>Bandung, Jawa Barat</a>
        </div>
      </div>
      <hr class="footer-divider" />
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <p class="footer-bottom mb-0">© 2025 TumblrVault.</p>
        <p class="footer-bottom mb-0">Laravel · Blade · Bootstrap 5</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>