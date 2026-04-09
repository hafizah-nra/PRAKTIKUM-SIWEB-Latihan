<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Categories;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalProducts = product::count();
        $totalCategories = Categories::count();
        $totalUsers = User::count();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalUsers' => $totalUsers,
        ]);
    }
}
