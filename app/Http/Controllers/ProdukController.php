<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
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

        // Find category by exact name match
        $kategori = category::where('category_name', $request->kategori)->first();

        if (!$kategori) {
            return back()->withErrors(['kategori' => 'Kategori tidak ditemukan. Silakan pilih kategori yang valid.'])->withInput();
        }

        try {
            product::create([
                'category_id'   => $kategori->category_id,
                'product_name'  => $request->nama,
                'product_price' => $request->harga,
                'product_stock' => $request->stok,
            ]);

            return redirect()->route('products')
                             ->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menyimpan produk: ' . $e->getMessage()])->withInput();
        }
    }
}