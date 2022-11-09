@extends('layouts.shop')

@section('content')
    <div class="row">
        <div class="col">
            <img
                class="img-thumbnail mx-auto d-block"
                src="https://via.placeholder.com/300"
                alt="{{ $product->name }}"
            >
        </div>
        <div class="col">
            <h2>{{ $product->name }}</h2>
            <p>Belongs to
                category:<br><b>{{ $product->category->name }}</b><br><b>{{ $product->category->description }}</b></p>
            <p>Description:<br><b>{{ $product->description }}</b></p>
            <p>Price:<br><b>{{ number_format($product->price, 2) }} &euro;</b></p>
            <p>Available quantity:<br><b>{{ $product->stock }}</b></p>

            <form action="#" method="post" class="row g-3">
                <div class="col-auto">
                    <label
                        for="add-cart-quantity"
                        class="form-control-plaintext"
                    >Quantity to purchase:</label>
                </div>
                <div class="col-auto">
                    <input
                        id="add-cart-quantity"
                        name="add-cart-quantity"
                        class="form-control"
                        type="number"
                        value="1"
                    >
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-success">Add to cart</button>
                </div>
            </form>

        </div>
    </div>
@endsection
