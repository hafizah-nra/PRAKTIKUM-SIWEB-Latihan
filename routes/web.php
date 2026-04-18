<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('check.login');
Route::post('/login', [AuthController::class, 'proses'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth.custom')->group(function () {
    // Dashboard (index dengan gambar hardcoded)
    Route::get('/dashboard', [ProdukController::class, 'index'])->name('dashboard');

    // Products (data dari database) → pakai ProductController
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/view', [ProductController::class, 'view'])->name('products.view');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Tambah Produk
    Route::get('/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
    Route::post('/tambah', [ProdukController::class, 'simpan'])->name('produk.simpan');
});