@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #fff0f5; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
    <h2 class="mb-4" style="color: #d63384; font-weight: bold;">💖 Checkout</h2>

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="shipping_address" class="form-label" style="color: #c71585;">📦 Shipping Address</label>
            <input type="text" name="shipping_address" id="shipping_address" class="form-control" required style="border-radius: 20px; border: 1px solid #ffb6c1;">
        </div>

        <div class="mb-3">
            <label class="form-label" style="color: #c71585;">💰 Payment Method</label>
            <input type="text" value="Cash on Delivery" class="form-control" disabled style="border-radius: 20px; background-color: #fffafc; color: #d63384;">
        </div>

        <div class="mb-3">
            <label for="note" class="form-label" style="color: #c71585;">📝 Note for Recipient (Optional)</label>
            <textarea name="note" id="note" class="form-control" rows="3" style="border-radius: 20px; border: 1px solid #ffb6c1;"></textarea>
        </div>

        <hr style="border-top: 2px dashed #ffb6c1;">

        <h5 style="color: #d63384;">🧸 Order Summary</h5>
        <ul class="list-group mb-3" style="border-radius: 15px; overflow: hidden;">
            @foreach($order->items as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #fffafc;">
                    {{ $item->product->name }} (x{{ $item->quantity }})
                    <span style="color: #d63384;">${{ number_format($item->price * $item->quantity, 2) }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold" style="background-color: #ffe4e1;">
                Total:
                <span style="color: #c71585;">${{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
            </li>
        </ul>

        <button type="submit" class="btn" style="background-color: #ff69b4; color: white; border-radius: 25px; padding: 10px 20px;">
            ✅ Place Order
        </button>
    </form>
</div>
@endsection
