<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    public function allProducts(): JsonResource
    {
        return ProductResource::collection(Product::with('category')->get());
    }

    public function activeProducts(string $active = 'active'): JsonResource
    {
        $isActive = $active === 'inactive' ? 0 : 1;

        $products = Product::where('is_active', $isActive)->get();

        return ProductResource::collection($products);
    }

    public function productsByCategory(string $active, ProductCategory $category): JsonResource
    {
        $isActive = $active === 'inactive' ? 0 : 1;
        $products = Product::with('category')
            ->where('is_active', $isActive)
            ->where('category_id', $category->id)
            ->get();

        return ProductResource::collection($products);
    }

    public function search(Request $request): JsonResource
    {
        $searchString = $request->query('q');

        $products = Product::where('name', 'LIKE' , '%'.$searchString.'%')
            ->orWhere('description', 'LIKE' , '%'.$searchString.'%')
            ->get();

        return ProductResource::collection($products);
    }
}
