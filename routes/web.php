<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    $allProducts = Product::with('category')->get();
    $productCount = $allProducts->count();
    $categoryCount = Category::count();

    $inventoryValue = $allProducts->sum(function ($product) {
        $price = $product->price ?? 0;
        $stock = $product->stock ?? 0;
        return $price * $stock;
    });

    $lowStockItems = $allProducts->where('stock', '<=', 5)->count();
    $recentProducts = $allProducts->sortByDesc('created_at')->take(5);

    $stockDistribution = Category::withSum('products', 'stock')
        ->get()
        ->pluck('products_sum_stock', 'name')
        ->filter(fn($stock) => $stock > 0)
        ->toArray();
    return view('dashboard', [
        'canEdit' => auth()->user()->is_admin,
        'productCount' => $productCount,
        'categoryCount' => $categoryCount,
        'inventoryValue' => $inventoryValue,
        'lowStockItems' => $lowStockItems,
        'recentProducts' => $recentProducts,
        'stockDistribution' => $stockDistribution,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');

        Route::middleware('admin')->group(function () {
            Route::post('products', [ProductController::class, 'store'])->name('products.store');
            Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

            Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    });
});

require __DIR__ . '/auth.php';
