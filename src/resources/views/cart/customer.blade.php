@extends('layouts.shop')

@section('title', 'Products')

@section('content')

    <h2>This cart belongs to: {{ $user->name }}</h2>

    <table class="table table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price, €</th>
            <th>Quantity</th>
            <th>Total, €</th>
        </tr>
        @foreach ($cart as $item)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td><a href="{{ route('products.show', [$item->product->id]) }}">{{ $item->product->name }}</a></td>
                <td>{{ $item->product->price }}</td>
                <td>{{ $item->count }}</td>
                <td>{{ number_format($item->count * $item->product->price, 2) }}</td>
            </tr>
        @endforeach
    </table>
@endsection
