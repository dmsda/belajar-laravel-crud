<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products?search=&category_id=&sort=-created_at&per_page=10
    public function index(Request $request)
    {
        $query = Product::query()->with(['category','user']);

        // Filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }
        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function($q) use ($s) {
                $q->where('name','like',"%$s%")
                  ->orWhere('description','like',"%$s%");
            });
        }

        // Sort (e.g. "name" atau "-price" untuk desc)
        if ($request->filled('sort')) {
            foreach (explode(',', $request->string('sort')) as $sort) {
                $dir = str_starts_with($sort, '-') ? 'desc' : 'asc';
                $col = ltrim($sort, '-');
                if (in_array($col, ['name','price','created_at'])) {
                    $query->orderBy($col, $dir);
                }
            }
        } else {
            $query->latest(); // default
        }

        $perPage = min(max((int) $request->get('per_page', 10), 1), 100);

        return ProductResource::collection($query->paginate($perPage)->appends($request->query()));
    }

    public function store(ProductRequest $request)
    {
        $product = $request->user()->products()->create($request->validated());
        return new ProductResource($product->load(['category','user']));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load(['category','user']));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->validated());
        return new ProductResource($product->load(['category','user']));
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return response()->json(['message' => 'deleted']);
    }
}
