<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::orderBy('name')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required','string','max:100','unique:categories,name']]);
        $category = Category::create($validated);
        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100','unique:categories,name,'.$category->id],
        ]);
        $category->update($validated);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return response()->json(['message' => 'Category in use'], 422);
        }
        $category->delete();
        return response()->json(['message' => 'deleted']);
    }
}
