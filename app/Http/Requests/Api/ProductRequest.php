<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('product')?->id;

        return [
            'name'        => ['required','string','max:150', Rule::unique('products','name')->ignore($id)],
            'description' => ['nullable','string'],
            'price'       => ['required','numeric','min:0'],
            'category_id' => ['required','exists:categories,id'],
        ];
    }
}
