<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success','Kategori dibuat');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success','Kategori diupdate');
    }

    public function destroy(Category $category)
    {
        // Cegah hapus jika masih dipakai produk
        if ($category->products()->exists()) {
            return back()->with('error','Kategori masih dipakai produk, tidak bisa dihapus.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success','Kategori dihapus');
    }
}
