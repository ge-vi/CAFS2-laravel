<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function allCategories()
    {
        // this will return json
        return ProductCategoryResource::collection(ProductCategory::orderBy('name')->get());
    }

    public function show(ProductCategory $category)
    {
        // Route Model Binding
        // https://laravel.com/docs/9.x/routing#route-model-binding
        // return $category;

        return new ProductCategoryResource($category);
    }
}
