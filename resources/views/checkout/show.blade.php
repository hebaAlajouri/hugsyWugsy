@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🧸 Checkout</h2>

    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="shipping_address" class="form-label">📦 Shipping Address</label>
            <input type="text" name="shipping_address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">💳 Payment Method</label><br>
            <label><input type="radio" name="payment_method" value="card" required> Credit Card</label><br>
            <label><input type="radio" name="payment_method" value="cash" required> Cash on Delivery</label>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">📝 Note for Recipient (optional)</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>

        <h4>🧾 Order Summary</h4>
        <ul class="list-group mb-3">
            @foreach($order->items as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <div>{{ $item->product->name }} x {{ $item->quantity }}</div>
                    <div>${{ number_format($item->price * $item->quantity, 2) }}</div>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                <span>Total:</span>
                <span>${{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 2) }}</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
    </form>
</div>
@endsection
