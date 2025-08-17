<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category','user'])->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->paginate(10)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('products.index', compact('products','categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'description' => ['nullable','string'],
            'price' => ['required','numeric','min:0'],
            'category_id' => ['required','exists:categories,id'],
        ]);

        auth()->user()->products()->create($request->validated());
        return redirect()->route('products.index')->with('success','Produk dibuat');
    }




    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product     = Product::findOrFail($id);
        $categories  = Category::orderBy('name')->get();
        $this->authorize('update', $product);
        return view('products.edit', compact('product','categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:150'],
            'description' => ['nullable','string'],
            'price' => ['required','numeric','min:0'],
            'category_id' => ['required','exists:categories,id'],
        ]);

        $this->authorize('update', $product);
        $product->update($request->validated()); // category_id ikut ter-update
        return redirect()->route('products.index')->with('success','Produk diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('products.index')->with('success','Produk dihapus');
    }



}
