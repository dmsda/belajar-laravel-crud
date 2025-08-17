<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

// endpoint ambil token
Route::post('/login-token', function (Request $request) {
    $data = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required'],
    ]);
    $user = User::where('email', $data['email'])->first();
    if (! $user || ! Hash::check($data['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
});

// lindungi & prefix-kan NAMA supaya tidak bentrok dengan web.*
Route::middleware('auth:sanctum')
    ->prefix('v1')
    ->name('api.') // <-- KUNCI: nama jadi api.products.index, dst
    ->group(function () {
        Route::apiResource('products', ApiProductController::class);
        Route::apiResource('categories', ApiCategoryController::class)->except(['create','edit']);
    });

Route::post('/logout-token', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'logged out']);
})->middleware('auth:sanctum');
