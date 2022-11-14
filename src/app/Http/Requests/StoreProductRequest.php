<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'numeric',
            'is_active' => ['required'],
            'category' => 'exists:App\Models\ProductCategory,id',
            'stock' => 'numeric',
            'name' => ['required', 'min:3', 'max:255'],
            'description' => 'required',
            'identifier' => ['required', 'numeric', 'digits:13'],
            'price' => 'numeric',
        ];
    }
}
