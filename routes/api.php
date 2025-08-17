<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

// Login untuk dapat token
Route::post('/login-token', function (Request $request) {
    $data = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $data['email'])->first();
    if (! $user || ! Hash::check($data['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // hapus token lama optional:
    // $user->tokens()->delete();

    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
});

// Logout (revoke token aktif)
Route::post('/logout-token', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'logged out']);
})->middleware('auth:sanctum');

// Endpoints terlindungi
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class)->except('create','edit');
});


