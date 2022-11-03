@extends('layouts.shop')

@section('title', 'Products')

@section('content')
    <table class="table table-bordered table-hover">
        <tr>
            <th>#</th>
            <th class="w-25">Product</th>
            <th>Quantity</th>
            <th class="w-25">Customer cart contents</th>
        </tr>
        @foreach ($carts as $cart)
            <tr>
                <td>{{ ++$loop->index  }}</td>
                <td><a href="{{ route('products.show', [$cart->product->id]) }}">{{ $cart->product->name }}</a></td>
                <td>{{ $cart->count }}</td>
                <td><a href="{{ route('cart.customer', [$cart->user->id]) }}">{{ $cart->user->name }}</a></td>
            </tr>
        @endforeach
    </table>
@endsection
