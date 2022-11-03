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
            'product_name' => ['required', 'min:3', 'max:255'],
            'product_description' => 'required',
            'product_category' => 'exists:product_categories,id',
            'product_price' => 'numeric'
        ];
    }
}
