<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// Halaman Utama
Route::get('/', function () {
    $products = \App\Models\product::all();
    return view('index', compact('products'));
})->name('home');

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses Form Login & Logout
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Produk
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// route untuk update produk
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// route untuk delete produk
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
