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
            'productName' => ['required', 'min:3', 'max:255'],
            'productDescription' => 'required',
            'productCategory' => 'exists:App\Models\ProductCategory,id',
            'productPrice' => 'numeric',
            'productStock' => 'numeric',
            'productIdentifier' => ['required', 'numeric', 'digits:13'],
            'productIsActive' => ['required']
        ];
    }
}
