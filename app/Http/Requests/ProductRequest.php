<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Product;

/** @property \App\Models\Product|null $product */
class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Kita sudah pakai middleware auth, aman untuk return true
        return true;
    }

    public function rules(): array
{
    $id = $this->route('product')?->id;

    return [
        'name'        => ['required','string','max:150', Rule::unique('products','name')->ignore($id)],
        'description' => ['nullable','string'],
        'price'       => ['required','numeric','min:0'],
        'category_id' => ['required','exists:categories,id'], // <- WAJIB ADA
    ];
}
}
