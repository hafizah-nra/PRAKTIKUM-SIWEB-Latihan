@extends('layouts.main')

@section('title', 'Edit Produk – TumblrVault')

@section('content')
<div class="tambah-header" style="padding-top: 120px;">
  <div class="container">
    <div class="d-flex align-items-center gap-3 mb-3">
      <a href="{{ route('products.index') }}" class="back-btn">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-cur">Edit Produk</span>
    </div>
    <h1 class="tambah-title">Edit Produk</h1>
    <p class="tambah-desc">Perbarui data atau gambar tumbler di inventori</p>
  </div>
</div>

<section class="tambah-body py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="form-card">
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

          <form method="POST" action="{{ route('products.update', $product->product_id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="form-section-title"><i class="bi bi-image me-2"></i>Foto Produk</div>
            <div class="mb-4">
              <div class="upload-area" id="uploadArea">
                <input type="file" id="fotoInput" name="product_image"
                  accept="image/jpeg,image/png,image/webp" class="upload-input" />
                <div class="upload-placeholder" id="uploadPlaceholder" style="display: {{ $product->product_image ? 'none' : 'flex' }};">
                  <i class="bi bi-cloud-arrow-up upload-icon"></i>
                  <p class="upload-text">Klik atau seret foto baru ke sini</p>
                  <p class="upload-hint">Biarkan kosong jika tidak ingin mengubah foto</p>
                </div>
                <div class="upload-preview" id="uploadPreview" style="display: {{ $product->product_image ? 'block' : 'none' }};">
                  <img id="previewImg" src="{{ $product->product_image ? asset('storage/' . $product->product_image) : '' }}" alt="Preview" />
                  <button type="button" class="upload-remove" id="removeImg">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              </div>
            </div>

            <hr class="form-divider" />
            <div class="form-section-title"><i class="bi bi-info-circle me-2"></i>Informasi Produk</div>

            <div class="mb-3">
                <label class="form-label-custom" for="product_name">Nama Produk <span class="required-star">*</span></label>
                <input type="text" id="product_name" name="product_name"
                  class="form-control form-control-custom @error('product_name') is-invalid @enderror"
                  value="{{ old('product_name', $product->product_name) }}" required />
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label-custom" for="category_id">Kategori <span class="required-star">*</span></label>
                <select id="category_id" name="category_id" class="form-control form-control-custom @error('category_id') is-invalid @enderror" required>
                  <option value="" disabled>Pilih kategori...</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ old('category_id', $product->category_id) == $cat->category_id ? 'selected' : '' }}>
                      {{ $cat->category_name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label-custom" for="brand_id">Brand <span class="required-star">*</span></label>
                <select id="brand_id" name="brand_id" class="form-control form-control-custom @error('brand_id') is-invalid @enderror" required>
                  <option value="" disabled>Pilih brand...</option>
                  @foreach($brands as $brand)
                    <option value="{{ $brand->brand_id }}" {{ old('brand_id', $product->brand_id) == $brand->brand_id ? 'selected' : '' }}>
                      {{ $brand->nama_brand }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label-custom" for="product_price">Harga Jual (Rp) <span class="required-star">*</span></label>
                <div class="input-prefix-wrap">
                  <span class="input-prefix">Rp</span>
                  <input type="number" id="product_price" name="product_price"
                    class="form-control form-control-custom with-prefix @error('product_price') is-invalid @enderror"
                    min="0" value="{{ old('product_price', $product->product_price) }}" required />
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label-custom" for="product_stock">Jumlah Stok <span class="required-star">*</span></label>
                <input type="number" id="product_stock" name="product_stock"
                  class="form-control form-control-custom @error('product_stock') is-invalid @enderror"
                  min="0" value="{{ old('product_stock', $product->product_stock) }}" required />
              </div>
            </div>

            <hr class="form-divider" />
            <div class="d-flex gap-3 justify-content-between flex-wrap">
              <a href="{{ route('products.index') }}" class="btn btn-outline-custom">
                <i class="bi bi-x-lg me-2"></i>Batal
              </a>
              <button type="submit" class="btn btn-primary-custom">
                <i class="bi bi-check2-circle me-2"></i>Simpan Perubahan
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fotoInput');
    const previewContainer = document.getElementById('uploadPreview');
    const placeholder = document.getElementById('uploadPlaceholder');
    const previewImg = document.getElementById('previewImg');
    const removeBtn = document.getElementById('removeImg');
    
    // Store original image src to restore if user cancels picking a new file
    const originalSrc = previewImg.src;

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    removeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.value = '';
        if (originalSrc && !originalSrc.endsWith('/')) {
            // Revert to original database image
            previewImg.src = originalSrc;
            previewContainer.style.display = 'block';
            placeholder.style.display = 'none';
        } else {
            // No original image
            previewContainer.style.display = 'none';
            placeholder.style.display = 'flex';
            previewImg.src = '';
        }
    });
});
</script>
@endpush
