@extends('layouts.shop')

@section('title', 'Products')

@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-3 text-center">
        @foreach ($products as $product)
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <p class="my-0 fw-bolder">{{ $product->name }}</p>
                        <p>Category ID: {{ $product->category->name }}</p>
                    </div>
                    <div class="card-body">
                        <p>{{ $product->description }}</p>
                        <p>Price: {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" type="button"
                           class="w-100 btn btn-lg btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
