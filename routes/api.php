<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Ini route untuk REST API. Kita beri prefix nama "api." agar
| tidak bentrok dengan route web (mis. "api.products.index")
| dan lindungi dengan Sanctum.
*/

// Login untuk mendapatkan Bearer Token (Public)
Route::post('/login-token', function (Request $request) {
    $data = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $data['email'])->first();

    if (! $user || ! Hash::check($data['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Optional: hapus token lama
    // $user->tokens()->delete();

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

// Group API terlindungi token + prefix nama "api."
Route::middleware('auth:sanctum')
    // ->prefix('v1') // opsional jika mau versioning URL: /api/v1/...
    ->name('api.')
    ->group(function () {

        // CRUD Produk (API)
        Route::apiResource('products', ApiProductController::class);

        // CRUD Kategori (API) - tanpa create/edit (hanya JSON)
        Route::apiResource('categories', ApiCategoryController::class)
            ->except(['create','edit']);

        // Logout: revoke token aktif
        Route::post('/logout-token', function (Request $request) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'logged out']);
        })->name('logout-token');
    });
