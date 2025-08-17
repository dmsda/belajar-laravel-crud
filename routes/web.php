<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Opsional: arahkan root ke /products (akan kena middleware auth)
Route::redirect('/', '/products');

// Semua halaman app dilindungi login
Route::middleware('auth')->group(function () {
    // CRUD Produk (web)
    Route::resource('products', ProductController::class);

    // CRUD Kategori (web) - tanpa halaman show
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// Route bawaan Breeze (login/register/password dll)
require __DIR__.'/auth.php';
