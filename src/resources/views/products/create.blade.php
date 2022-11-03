@extends('layouts.shop')

@section('title', 'Products - Create')

@section('content')

    <h1 class="text-center">Create new product</h1>

    <div class="row">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('products.create') }}"
            class="col-6 offset-3">

            @csrf

            <label>Name</label>
            <input name="product_name" class="form-control">

            <label>Description</label>
            <input name="product_description" class="form-control">

            <label>Category</label>
            <select name="product_category" class="form-select">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->id }})</option>
                @endforeach
            </select>

            <label>Price</label>
            <input name="product_price" class="form-control">

            <button type="submit" class="btn btn-outline-success my-3">Create new product</button>
        </form>
    </div>

@endsection
