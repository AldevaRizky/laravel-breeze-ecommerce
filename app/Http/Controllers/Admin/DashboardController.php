<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalUsers', 'totalCategories', 'totalProducts'));
    }
}

