<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        $products = product::with('categories')->paginate(10);
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created product in database
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/products'), $filename);
            $validated['image'] = 'assets/products/' . $filename;
        }

        // Create product
        $product = product::create($validated);

        // Attach categories if provided
        if (!empty($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(product $product)
    {
        $categories = Categories::all();
        $selectedCategories = $product->categories->pluck('id')->toArray();
        
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'selectedCategories' => $selectedCategories,
        ]);
    }

    /**
     * Update the specified product in database
     */
    public function update(Request $request, product $product)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/products'), $filename);
            $validated['image'] = 'assets/products/' . $filename;
        }

        // Update product
        $product->update($validated);

        // Sync categories if provided
        if (isset($validated['categories'])) {
            $product->categories()->sync($validated['categories']);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product from database
     */
    public function destroy(product $product)
    {
        // Delete image file if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete associated categories
        $product->categories()->detach();
        
        // Delete product
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
