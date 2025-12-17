<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $totalItems = Product::count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        $chartData = Category::withCount('products')->get();
        $categoryNames = $chartData->pluck('name');
        $categoryCounts = $chartData->pluck('products_count');

        $products = Product::with('category')->latest()->take(5)->get();
        $activities = ActivityLog::with('user')->latest()->take(8)->get();
        $categories = Category::all();

        return view('dashboard', compact(
            'totalItems',
            'lowStockCount',
            'categoryNames',
            'categoryCounts',
            'products',
            'activities',
            'categories'
        ));
    }
}
