<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $products = product::with('category')->get();
        return view('product', compact('products', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('product_image')) {
            // Simpan file ke dalam folder: storage/app/public/products
            $imagePath = $request->file('product_image')->store('products', 'public');
            // Masukkan path/nama file ke dalam array $validateData untuk disimpan ke DB
            $validateData['product_image'] = $imagePath;
        }

        product::create($validateData);

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);

        $validateData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // jika user meng-upload gambar baru
        if ($request->hasFile('product_image')) {
            // Hapus gambar lama dari storage (jika ada)
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('product_image')->store('products', 'public');
            $validateData['product_image'] = $imagePath;
        }

        // Update data ke database
        $product->update($validateData);

        return redirect()->route('products')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);

        // Hapus gambar dari storage (jika ada)
        if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
            Storage::disk('public')->delete($product->product_image);
        }

        // Hapus data produk dari database
        $product->delete();

        return redirect()->route('products')->with('deleted', 'Produk berhasil dihapus!');
    }
}