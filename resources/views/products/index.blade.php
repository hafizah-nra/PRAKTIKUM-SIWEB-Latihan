@extends('layouts.main')

@section('title', 'Daftar Produk – TumblrVault')

@section('content')
<div class="tambah-header" style="padding-top: 120px; padding-bottom: 40px;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
      <div>
        <h1 class="tambah-title">Koleksi Tumbler</h1>
        <p class="tambah-desc mb-0">Lihat semua inventaris produk Anda di sini</p>
      </div>
      @if(auth()->check() && auth()->user()->isAdmin())
      <a href="{{ route('products.create') }}" class="btn btn-primary-custom shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Tumbler
      </a>
      @endif
    </div>
  </div>
</div>

<section class="product-section pt-5" id="produk">
  <div class="container">
    <div class="row g-4">
      @forelse($products as $p)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="product-slide-card" data-id="{{ $p->product_id }}" style="min-width:100%;">
          <div class="pcard-img-wrap">
            @if($p->product_image)
              <img src="{{ asset('storage/' . $p->product_image) }}" class="pcard-img" alt="{{ $p->product_name }}" style="object-fit:cover;" />
            @else
              <img src="{{ asset('assets/stanley.jpg') }}" class="pcard-img" alt="Placeholder" />
            @endif
            @auth
            <button class="btn-wishlist-card"><i class="bi bi-heart"></i></button>
            @endauth
          </div>
          <div class="pcard-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="badge-stock {{ $p->product_stock > 5 ? 'badge-in' : 'badge-low' }}">
                {{ $p->product_stock > 5 ? 'Tersedia' : 'Stok Tipis' }}
              </span>
              <span class="pcard-sku">SKU-{{ $p->product_id }}</span>
            </div>
            <h5 class="pcard-name text-truncate" title="{{ $p->product_name }}">{{ $p->product_name }}</h5>
            <p class="pcard-category mb-1"><i class="bi bi-layers me-1"></i>{{ $p->category->category_name }}</p>
            <p class="pcard-brand mb-2"><i class="bi bi-tag me-1"></i>{{ $p->brand->nama_brand }}</p>
            <p class="stok-text"><i class="bi bi-box-seam me-1"></i>Stok: {{ $p->product_stock }}</p>
            <hr class="pcard-divider" />
            <div class="d-flex justify-content-between align-items-center">
              <span class="pcard-price">Rp {{ number_format($p->product_price, 0, ',', '.') }}</span>
              <div class="d-flex gap-1">
                @if(auth()->check() && auth()->user()->isAdmin())
                  <a href="{{ route('products.edit', $p->product_id) }}" class="btn-detail-view" style="padding:4px 8px; font-size:0.8rem;" title="Edit"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('products.destroy', $p->product_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-detail-buy" style="padding:4px 8px; font-size:0.8rem; background:rgba(201,123,90,0.1); color:#a05a2c;" title="Hapus"><i class="bi bi-trash"></i></button>
                  </form>
                @else
                  <button class="btn-detail-view btn-view-detail" data-id="{{ $p->product_id }}">Detail</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <i class="bi bi-box2 display-1 text-muted mb-3" style="opacity:0.2;"></i>
        <h4 class="text-muted">Belum ada produk</h4>
        @if(auth()->check() && auth()->user()->isAdmin())
        <p class="mb-4">Silakan tambah produk baru ke dalam sistem.</p>
        <a href="{{ route('products.create') }}" class="btn btn-primary-custom">Tambah Produk</a>
        @endif
      </div>
      @endforelse
    </div>
  </div>
</section>

{{-- Modal Detail Produk (untuk user biasa) --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-detail">
    <div class="modal-content modal-content-custom">
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title-custom">
          <i class="bi bi-box-seam me-2" style="color:var(--dusty)"></i>Detail Produk
        </h5>
        <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="detail-img-wrap">
          <img id="detail-img" src="" alt="" class="detail-img" />
          <div class="detail-badge-wrap">
            <span id="detail-badge" class="badge-stock"></span>
          </div>
        </div>
        <div class="detail-info">
          <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
            <h4 class="detail-nama" id="detail-nama">—</h4>
            <span class="detail-sku" id="detail-sku">—</span>
          </div>
          <p class="detail-category" id="detail-category"><i class="bi bi-layers me-1"></i>—</p>
          <p class="detail-category" id="detail-brand" style="margin-top:-5px;"><i class="bi bi-tag me-1"></i>—</p>
          <div class="detail-price-row mt-3">
            <div>
              <div class="detail-price-label">Harga</div>
              <div class="detail-price" id="detail-harga">—</div>
            </div>
            <div>
              <div class="detail-price-label">Stok</div>
              <div class="detail-stok" id="detail-stok-val">—</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-footer-custom justify-content-end">
        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn-buy-modal">
          <i class="bi bi-bag-plus me-2"></i>Beli Sekarang
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Detail Modal Logic
    const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
    document.querySelectorAll('.btn-view-detail').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            const productId = e.currentTarget.dataset.id;
            try {
                // Fetch product details
                const response = await fetch(`/products/${productId}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                
                // Populate Modal
                document.getElementById('detail-nama').textContent = data.product_name;
                document.getElementById('detail-sku').textContent = `SKU-${data.product_id}`;
                document.getElementById('detail-category').innerHTML = `<i class="bi bi-layers me-1"></i>${data.category.category_name}`;
                document.getElementById('detail-brand').innerHTML = `<i class="bi bi-tag me-1"></i>${data.brand.nama_brand}`;
                document.getElementById('detail-harga').textContent = `Rp ${Number(data.product_price).toLocaleString('id-ID')}`;
                document.getElementById('detail-stok-val').textContent = data.product_stock;
                
                const badge = document.getElementById('detail-badge');
                if (data.product_stock > 5) {
                    badge.textContent = 'Tersedia';
                    badge.className = 'badge-stock badge-in';
                } else {
                    badge.textContent = 'Stok Tipis';
                    badge.className = 'badge-stock badge-low';
                }
                
                const img = document.getElementById('detail-img');
                img.src = data.product_image ? `/storage/${data.product_image}` : '/assets/stanley.jpg';
                
                detailModal.show();
            } catch (error) {
                console.error('Error fetching product details:', error);
                alert('Gagal memuat detail produk.');
            }
        });
    });
});
</script>
@endpush
