@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #fff0f5; border-radius: 15px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
    <h2 class="mb-4" style="color: #d63384; font-weight: bold;">🛒 Your Cute Cart</h2>

    @if($order && $order->items->count())
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" style="background-color: #fffafc;">
                <thead class="table-light">
                    <tr style="color: #c71585;">
                        <th>🐻 Bear</th>
                        <th>📦 Quantity</th>
                        <th>💰 Price</th>
                        <th>🧹 Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td style="color: #d63384;">{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background-color: #ffb6c1; color: white; border-radius: 20px;">
                                        ❌ Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('shop.index') }}" class="btn" style="background-color: #ffe4e1; color: #d63384; border-radius: 25px;">
                ➕ Add More Bears
            </a>

            <a href="{{ route('checkout.form') }}" class="btn" style="background-color: #ff69b4; color: white; border-radius: 25px;">
                ✅ Proceed to Checkout
            </a>
        </div>
    @else
        <p class="mt-3" style="color: #d63384;">Your cart is empty. 
            <a href="{{ route('shop.index') }}" style="color: #ff69b4; text-decoration: underline;">
                Start shopping!
            </a>
        </p>
    @endif
</div>
@endsection
