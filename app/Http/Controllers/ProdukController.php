<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function tambah()
    {
        return view('tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'sku'       => 'required|string|max:50',
            'kategori'  => 'required|string',
            'kapasitas' => 'required|integer|min:100|max:3000',
            'harga'     => 'required|integer|min:1000',
            'stok'      => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        return redirect()->route('dashboard')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }
}