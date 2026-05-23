<footer class="footer-custom mt-auto">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-4">
        <div class="footer-brand">Tumblr<span>Vault</span></div>
        <p class="footer-desc">Sistem manajemen penjualan tumbler yang sederhana dan efisien.</p>
        <div class="mt-4">
          <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
          <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2">
        <div class="footer-heading">Navigasi</div>
        <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
        <a href="{{ route('products.index') }}" class="footer-link">Produk</a>
        @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('products.create') }}" class="footer-link">Tambah Produk</a>
        @endif
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
      <p class="footer-bottom mb-0">© {{ date('Y') }} TumblrVault.</p>
      <p class="footer-bottom mb-0">Laravel · Blade · Bootstrap 5</p>
    </div>
  </div>
</footer>
