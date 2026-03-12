<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('check.login');
Route::post('/login', [AuthController::class, 'proses'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.custom')->group(function () {
    Route::get('/dashboard', [ProdukController::class, 'index'])->name('dashboard');
    Route::get('/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
    Route::post('/tambah', [ProdukController::class, 'simpan'])->name('produk.simpan');
});