{{-- resources/views/orders/checkout.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    {{-- Display order details --}}
    <h3>Order Summary</h3>
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

    {{-- Checkout form --}}
    <form action="{{ route('order.complete', $order->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Complete Checkout</button>
    </form>
</div>
@endsection
