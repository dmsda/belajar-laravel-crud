<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('category')?->id;

        return [
            'name' => ['required','string','max:100', Rule::unique('categories','name')->ignore($id)],
        ];
    }

    public function messages(): array
    {
        return ['name.unique' => 'Nama kategori sudah digunakan.'];
    }
}
