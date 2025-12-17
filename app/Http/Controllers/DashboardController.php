<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $canEdit = Auth::check() && Auth::user()->is_admin;

        $totalProducts = Product::count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        $totalInventoryValue = Product::sum(DB::raw('price * stock'));
        $categoryCount = Category::count();

        $chartData = Category::withCount('products')->get();
        $labels = $chartData->pluck('name')->toArray();
        $counts = $chartData->pluck('products_count')->toArray();

        $recentProducts = Product::with('category')->latest()->take(5)->get();

        $lowStockItems = Product::where('stock', '<=', 5)->take(3)->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockCount',
            'totalInventoryValue',
            'categoryCount',
            'recentProducts',
            'labels',
            'counts',
            'lowStockItems',
            'canEdit'
        ));
    }
}
