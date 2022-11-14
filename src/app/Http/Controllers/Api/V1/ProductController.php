<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function show(Product $product): JsonResource
    {
//        $singleProduct = Product::with('category')
//            ->where('is_active', true)
//            ->where('id', $product->id)
//            ->limit(1)
//            ->get();

        return new ProductResource($product);
    }

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

        $products = Product::where('name', 'LIKE', '%'.$searchString.'%')
            ->orWhere('description', 'LIKE', '%'.$searchString.'%')
            ->get();

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $request->validated();

        $product = Product::create([
            'name' => htmlspecialchars($product['name']),
            'description' => htmlspecialchars($product['description']),
            'category_id' => $product['category'],
            'identifier' => $product['identifier'],
            'price' => $product['price'],
            'stock' => $product['stock'],
            'is_active' => $product['is_active'],
        ]);

        return $product;
    }

    public function update(Product $product, StoreProductRequest $request)
    {
        $product->update($request->all());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
