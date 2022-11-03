<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // https://laravel.com/docs/9.x/eloquent-relationships#eager-loading

        // "lazy load" - data is only "one level deep"
        // simple but slow way to query database: 30+ queries => 22ms
        // $products = Product::all();

        // "eager load" - data loaded "with child models"
        // so in result only 2 queries executed in 6ms
        $products = Product::with('category')
            ->where('is_active', true)
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all(['id', 'name'])->sortBy('name');
        return view('products.create')->with('categories', $categories);
    }

    public function store(StoreProductRequest $request)
    {
        $productData = $request->validated();
        dd($productData);
    }

    public function edit()
    {
        return view('products.edit');
    }

    public function show(Product $product)
    {
//        $product = Product::with('category')->get();
        return view('products.show', ['product' => $product]);
    }
}
