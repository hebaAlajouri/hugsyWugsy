@extends('layouts.app')

@section('title', 'Checkout | HugsyWugsy')

@section('content')
<div class="checkout-container">
    <h1 class="checkout-title">🛒 Final Step: Complete Your Order!</h1>

    <div class="checkout-form">
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

        <form action="{{ route('pages.checkout.placeOrder') }}" method="POST">
            @csrf

            <!-- Shipping Information -->
            <h2>📦 Shipping Details</h2>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" id="full_name" required placeholder="Your full name">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" rows="3" required placeholder="Delivery address..."></textarea>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" required placeholder="City">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" required placeholder="Phone number">
            </div>

            <!-- Payment Method -->
            <h2>💳 Payment Method</h2>
            <div class="form-group">
                <select name="payment_method" id="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>

            <!-- Order Summary -->
            <h2>🧸 Order Summary</h2>
            <div class="order-summary">
                <p><strong>Subtotal:</strong> $120.00</p>
                <p><strong>Shipping:</strong> $5.00</p>
                <p><strong>Total:</strong> $125.00</p>
            </div>

            <!-- Place Order Button -->
            <button type="submit" class="place-order-btn">✨ Place Order ✨</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush
