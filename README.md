# 🥤 TumblrVault

**TumblrVault** adalah sebuah purwarupa (prototype) Sistem Informasi Berbasis Web untuk manajemen penjualan dan inventaris produk *tumbler* (botol minum). Proyek ini dikembangkan menggunakan kerangka kerja Laravel dan merupakan bagian dari Tugas Akhir Praktikum Sistem Informasi Berbasis Web.

Aplikasi ini mendemonstrasikan implementasi fitur-fitur standar industri web seperti autentikasi pengguna, manajemen hak akses (role), operasi CRUD (Create, Read, Update, Delete) yang dinamis, hingga kemampuan manajemen berkas (upload gambar).

---

## ✨ Fitur Utama

Aplikasi TumblrVault dirancang untuk memenuhi beberapa kriteria fungsionalitas berikut:

1. **Slicing Template (Blade)**
   - Menggunakan arsitektur Blade Components & Layouts.
   - Halaman dipisahkan secara modular menjadi `layouts/main`, serta _partials_ untuk elemen berulang seperti navigasi (`navbar`) dan kaki halaman (`footer`).
2. **Autentikasi (Laravel Breeze)**
   - Menggantikan sistem sesi (_session_) manual/hardcoded dengan sistem autentikasi standar bawaan Laravel yang lebih aman.
   - Formulir pendaftaran dan masuk (Login/Register) dimodifikasi menyesuaikan tampilan gaya visual aplikasi.
3. **Role Management (Admin & User)**
   - Hak akses dipisahkan menjadi dua: **Admin** dan **User**.
   - Admin memiliki wewenang penuh untuk mengubah inventaris barang (Tambah, Edit, Hapus).
   - User (Pengguna Biasa) hanya memiliki wewenang untuk melihat detail barang di etalase dan mengelola profil mereka sendiri.
4. **CRUD Produk & Upload Gambar**
   - Mendukung manipulasi data produk secara komprehensif.
   - Mendukung fungsi unggah foto produk dan unggah foto profil yang disimpan menggunakan ekosistem `Storage` lokal bawaan Laravel.
5. **Dashboard & Profil Dinamis**
   - Halaman profil pengguna untuk mengubah nama, email, kata sandi, serta foto profil.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** [Laravel](https://laravel.com) v11+ (PHP)
- **Frontend:** HTML5, Vanilla CSS, Blade Templating, dan [Bootstrap 5](https://getbootstrap.com/)
- **Database:** MySQL
- **Development Environment:** Laragon / XAMPP, Composer, NPM

---

## 🚀 Panduan Instalasi & Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal di komputer Anda:

1. **Persiapkan Lingkungan (Environment)**
   Salin file `.env.example` menjadi `.env` lalu sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   ```

2. **Instalasi Dependensi**
   Jalankan perintah berikut untuk mengunduh semua library PHP dan Node.js yang dibutuhkan.
   ```bash
   composer install
   npm install
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Migrasi Database & Seeding**
   Langkah ini akan membuat seluruh tabel di database dan mengisinya dengan data percobaan (termasuk akun pengguna).
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Tautkan Folder Storage (Storage Link)**
   Langkah wajib agar gambar produk dan foto profil yang diunggah dapat ditampilkan di halaman web.
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Aplikasi**
   Kompilasi *assets* frontend dan nyalakan server lokal Laravel.
   ```bash
   npm run build
   php artisan serve
   ```

Aplikasi sekarang dapat diakses melalui browser pada alamat: `http://localhost:8000`

---

## 🔑 Akun Uji Coba (Testing)

Anda dapat menggunakan kredensial berikut untuk masuk dan menguji fungsionalitas sistem:

### Akun Administrator (Akses Penuh CRUD)
- **Email:** `admin@gmail.com`
- **Password:** `admin123`

### Akun Pengguna Biasa (Hanya Lihat Produk)
- **Email:** `hafizah@gmail.com`
- **Password:** `12345678`

---
*Dibuat untuk memenuhi Tugas Praktikum SIWEB.*
