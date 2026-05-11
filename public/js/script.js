const btnTheme = document.getElementById('btn-theme');
const body = document.body;

if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    btnTheme.innerText = "Mode Terang";
}

btnTheme.addEventListener('click', function () {
    body.classList.toggle('dark-mode');

    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        btnTheme.innerText = "Mode Terang";
    } else {
        localStorage.removeItem('theme');
        btnTheme.innerText = "Mode Gelap";
    }
});

function aktifkanTombolBeli() {
    const tombolBeli = document.querySelectorAll('.btn-detail');

    tombolBeli.forEach(function (button) {
        button.replaceWith(button.cloneNode(true));
    });

    const tombolBaru = document.querySelectorAll('.btn-detail');

    tombolBaru.forEach(function (button) {
        button.addEventListener('click', function (e) {
            const cardBody = e.target.closest('.card-body');
            const stokElement = cardBody.querySelector('.stok-text');

            let stok = parseInt(stokElement.innerText.replace("Stok: ", ""));

            if (stok > 0) {
                stok--;
                stokElement.innerText = "Stok: " + stok;

                const namaBarang = cardBody.querySelector('.card-title').innerText;
                alert("Berhasil membeli " + namaBarang);
            } else {
                alert("Stok Habis!");
                e.target.disabled = true;
                e.target.innerText = "Habis";
            }
        });
    });
}

aktifkanTombolBeli();

// Whislist menggunakan SessionStorage 
function updateBadgeWishlist() {
    let wishlist = JSON.parse(sessionStorage.getItem('wishlist')) || [];
    document.getElementById('wishlist-count').innerText = wishlist.length;
}

function aktifkanTombolWishlist() {
    const semuaTombolWishlist = document.querySelectorAll('.btn-wishlist');

    semuaTombolWishlist.forEach(function (button) {
        button.replaceWith(button.cloneNode(true));
    });

    const tombolBaru = document.querySelectorAll('.btn-wishlist');

    tombolBaru.forEach(function (button) {
        button.addEventListener('click', function (e) {
            const cardBody = e.target.closest('.card-body');
            const namaBarang = cardBody.querySelector('.card-title').innerText;

            let wishlist = JSON.parse(sessionStorage.getItem('wishlist')) || [];

            if (!wishlist.includes(namaBarang)) {
                wishlist.push(namaBarang);

                sessionStorage.setItem('wishlist', JSON.stringify(wishlist));

                alert(namaBarang + " berhasil ditambahkan ke Wishlist!");
                updateBadgeWishlist();
            } else {
                alert(namaBarang + " sudah ada di Wishlist kamu.");
            }
        });
    });
}

// Fungsi untuk merender daftar di dalam Pop-up Modal
function tampilkanWishlist() {
    const daftarWishlist = document.getElementById('daftar-wishlist');
    let wishlist = JSON.parse(sessionStorage.getItem('wishlist')) || [];

    daftarWishlist.innerHTML = "";

    if (wishlist.length === 0) {
        let liKosong = document.createElement('li');
        liKosong.className = "list-group-item text-center text-muted";
        liKosong.innerText = "Belum ada barang di wishlist.";
        daftarWishlist.appendChild(liKosong);
    } else {
        wishlist.forEach(function (item) {
            let li = document.createElement('li');
            li.className = "list-group-item d-flex justify-content-between align-items-center";
            li.innerText = item;

            daftarWishlist.appendChild(li);
        });
    }
}

// Fungsi tombol Kosongkan
function hapusWishlist() {
    sessionStorage.removeItem('wishlist');
    updateBadgeWishlist();
    tampilkanWishlist();
}

updateBadgeWishlist();
aktifkanTombolWishlist();
