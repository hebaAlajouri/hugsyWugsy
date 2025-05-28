@extends('layouts.app')

@section('content')
<style>
    .cart-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #fdf2f8 0%, #fef7f7 50%, #faf5ff 100%);
    }
    
    .cart-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .cart-title {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(to right, #ec4899, #fb7185, #a855f7);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.5rem;
    }
    
    .cart-subtitle {
        color: #e11d48;
        font-weight: 500;
    }
    
    .cart-items-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid #fbcfe8;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .cart-header-row {
        background: linear-gradient(to right, #f472b6, #fb7185, #a855f7);
        color: white;
        padding: 1.5rem;
    }
    
    .cart-header-grid {
        display: grid;
        grid-template-columns: 1fr 0.5fr 0.75fr 0.75fr;
        gap: 1rem;
        align-items: center;
        font-weight: 600;
        font-size: 1.125rem;
    }
    
    .cart-item-row {
        padding: 1.5rem;
        border-bottom: 1px solid #fce7f3;
        transition: all 0.3s ease;
    }
    
    .cart-item-row:hover {
        background: rgba(251, 207, 232, 0.3);
    }
    
    .cart-item-grid {
        display: grid;
        grid-template-columns: 1fr 0.5fr 0.75fr 0.75fr;
        gap: 1rem;
        align-items: center;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .product-icon {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #fbcfe8, #fecaca);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .product-details h3 {
        font-weight: 600;
        color: #374151;
        font-size: 1.125rem;
        margin-bottom: 0.25rem;
    }
    
    .product-details p {
        color: #f43f5e;
        font-size: 0.875rem;
    }
    
    .quantity-badge {
        display: inline-flex;
        align-items: center;
        background: #fce7f3;
        border-radius: 1rem;
        padding: 0.5rem 1rem;
        justify-content: center;
    }
    
    .quantity-badge span {
        color: #e11d48;
        font-weight: 600;
        font-size: 1.125rem;
    }
    
    .price-display {
        font-size: 1.5rem;
        font-weight: bold;
        color: #9333ea;
        text-align: center;
    }
    
    .remove-btn {
        background: linear-gradient(to right, #fb7185, #f472b6);
        color: white;
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .remove-btn:hover {
        background: linear-gradient(to right, #f43f5e, #ec4899);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
    }
    
    .cart-total {
        background: linear-gradient(to right, #e9d5ff, #fce7f3);
        padding: 1.5rem;
        border-top: 1px solid #fbcfe8;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .total-label {
        font-size: 1.125rem;
        font-weight: 600;
        color: #374151;
    }
    
    .total-amount {
        font-size: 1.875rem;
        font-weight: bold;
        background: linear-gradient(to right, #9333ea, #ec4899);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: center;
        align-items: center;
    }
    
    @media (min-width: 640px) {
        .action-buttons {
            flex-direction: row;
        }
    }
    
    .action-btn {
        background: linear-gradient(to right, #f472b6, #fb7185, #a855f7);
        color: white;
        font-weight: bold;
        padding: 1rem 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.125rem;
    }
    
    .action-btn:hover {
        background: linear-gradient(to right, #ec4899, #f43f5e, #9333ea);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }
    
    .checkout-btn {
        background: linear-gradient(to right, #a855f7, #ec4899, #f43f5e);
    }
    
    .checkout-btn:hover {
        background: linear-gradient(to right, #9333ea, #db2777, #e11d48);
    }
    
    .empty-cart {
        text-align: center;
    }
    
    .empty-cart-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid #fbcfe8;
        padding: 3rem;
        max-width: 32rem;
        margin: 0 auto;
    }
    
    .empty-cart-icons {
        margin-bottom: 1.5rem;
    }
    
    .empty-cart-icons .cart-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
    }
    
    .empty-cart-icons .heart-icon {
        font-size: 3.75rem;
        opacity: 0.5;
    }
    
    .empty-cart h2 {
        font-size: 1.875rem;
        font-weight: bold;
        color: #374151;
        margin-bottom: 1rem;
    }
    
    .empty-cart p {
        color: #e11d48;
        font-size: 1.125rem;
        margin-bottom: 2rem;
        line-height: 1.75;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
</style>
<div class="cart-container">
    <div class="container">
        <!-- Header Section -->
        <div class="cart-header">
            <h1 class="cart-title">
                ✨ Your Adorable Cart ✨
            </h1>
            <p class="cart-subtitle">Filled with love and cuteness 💕</p>
        </div>

        @if($order && $order->items->count())
            <!-- Cart Items Section -->
            <div class="cart-items-container">
                <!-- Table Header -->
                <div class="cart-header-row">
                    <div class="cart-header-grid">
                        <div>
                            <span>🧸</span> Sweet Bears
                        </div>
                        <div style="text-align: center;">
                            <span>💖</span> Quantity
                        </div>
                        <div style="text-align: center;">
                            <span>💎</span> Price
                        </div>
                        <div style="text-align: center;">
                            <span>✨</span> Actions
                        </div>
                    </div>
                </div>

                <!-- Cart Items -->
                <div>
                    @foreach($order->items as $item)
                        <div class="cart-item-row">
                            <div class="cart-item-grid">
                                <!-- Product Name -->
                                <div>
                                    <div class="product-info">
                                        <div class="product-icon">
                                            🧸
                                        </div>
                                        <div class="product-details">
                                            <h3>{{ $item->product->name }}</h3>
                                            <p>Made with love 💕</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div style="text-align: center;">
                                    <div class="quantity-badge">
                                        <span>{{ $item->quantity }}</span>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="price-display">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>

                                <!-- Actions -->
                                <div style="text-align: center;">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">
                                            <span>🗑️</span> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Total -->
                <div class="cart-total">
                    <div class="total-label">
                        ✨ Total Cuteness Value:
                    </div>
                    <div class="total-amount">
                        ${{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 2) }}
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('shop.index') }}" class="action-btn">
                    <span>🛍️</span>
                    <span>Add More Cuties</span>
                </a>
                
                <a href="{{ route('checkout.form') }}" class="action-btn checkout-btn">
                    <span>💖</span>
                    <span>Checkout with Love</span>
                </a>
            </div>

        @else
            <!-- Empty Cart Section -->
            <div class="empty-cart">
                <div class="empty-cart-container">
                    <div class="empty-cart-icons">
                        <div class="cart-icon">🛒</div>
                        <div class="heart-icon">💔</div>
                    </div>
                    
                    <h2>
                        Your cart feels lonely! 🥺
                    </h2>
                    
                    <p>
                        It's waiting for some adorable bears to fill it with joy and cuteness! ✨
                    </p>
                    
                    <a href="{{ route('products.index') }}" class="action-btn">
                        <span>🌟</span>
                        <span>Start Shopping for Cuties!</span>
                        <span>💕</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection