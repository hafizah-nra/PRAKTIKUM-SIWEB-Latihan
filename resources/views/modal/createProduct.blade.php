<!-- Modal Tambah Produk -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required />
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="product_price" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" required />
                    </div>

                    <div class="mb-3">
                        <label for="product_stock" class="form-label">Stok Produk</label>
                        <input type="number" class="form-control" id="product_stock" name="product_stock" required />
                    </div>

                    <div class="mb-3">
                        <label for="product_image" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="product_image" name="product_image" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>