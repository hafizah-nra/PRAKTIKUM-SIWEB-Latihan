{{-- code untuk file modal/wishlist.blade.php --}}
<div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Wishlist Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="daftar-wishlist">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger" onclick="hapusWishlist()">Kosongkan</button>
                </div>
            </div>
        </div>
</div>
{{-- batas code modal/wishlist.blade.php --}}