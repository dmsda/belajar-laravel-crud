<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::redirect('/', '/products'); // opsional: arahkan home ke products

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

     Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
});

// route auth (dari Breeze)
require __DIR__.'/auth.php';

