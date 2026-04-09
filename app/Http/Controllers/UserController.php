<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Categories;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display landing page with all products
     */
    public function landing()
    {
        $products = product::with('categories')->get();
        $categories = Categories::all();
        
        return view('user.landing', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Filter products by category
     */
    public function filterByCategory($categoryId)
    {
        $category = Categories::findOrFail($categoryId);
        $products = $category->products()->with('categories')->get();
        $categories = Categories::all();

        return view('user.landing', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }
}
