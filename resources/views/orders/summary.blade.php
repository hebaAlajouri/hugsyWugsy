{{-- resources/views/orders/summary.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Summary</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Checkout button --}}
    <a href="{{ route('order.checkout', $order->id) }}" class="btn btn-primary">Proceed to Checkout</a>
</div>
@endsection
