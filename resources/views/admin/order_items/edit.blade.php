@extends('layouts.admin')

@section('content')
{{-- 🌸 Custom Styles --}}
<style>
    .edit-container {
        background: linear-gradient(135deg, #ffeef8 0%, #f8f4ff 100%);
        min-height: 100vh;
        padding: 2rem;
    }
    
    .form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 25px;
        padding: 3rem;
        max-width: 700px;
        margin: 0 auto;
        box-shadow: 0 15px 40px rgba(255, 182, 193, 0.25);
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #ff9a9e 0%, #fecfef 50%, #a29bfe 100%);
    }
    
    .page-title {
        color: #6b4c7a;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        text-shadow: 2px 2px 4px rgba(255, 182, 193, 0.3);
    }
    
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-label {
        color: #8b5a96;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #f0e6f7;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        color: #5a4a6b;
        font-weight: 500;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #c44569;
        background: white;
        box-shadow: 0 5px 20px rgba(196, 69, 105, 0.15);
        transform: translateY(-2px);
    }
    
    .form-control-custom::placeholder {
        color: #b298c7;
        font-style: italic;
    }
    
    .select-wrapper {
        position: relative;
    }
    
    .select-wrapper::after {
        content: '💖';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 1.2rem;
    }
    
    .form-select-custom {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: rgba(255, 255, 255, 0.8);
        padding-right: 50px;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
        border: none;
        border-radius: 25px;
        padding: 15px 40px;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
        cursor: pointer;
    }
    
    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(196, 69, 105, 0.4);
        color: white;
    }
    
    .submit-btn:active {
        transform: translateY(-1px);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #8b5a96;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        padding: 10px 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.7);
        border: 2px solid rgba(255, 182, 193, 0.2);
        transition: all 0.3s ease;
    }
    
    .back-link:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #6b4c7a;
        text-decoration: none;
        transform: translateX(-5px);
        border-color: rgba(255, 182, 193, 0.4);
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #b298c7;
        pointer-events: none;
        z-index: 1;
    }
    
    .has-icon .form-control-custom {
        padding-left: 50px;
    }
    
    .has-icon .form-select-custom {
        padding-left: 50px;
    }
    
    .form-hint {
        font-size: 0.85rem;
        color: #b298c7;
        margin-top: 0.5rem;
        font-style: italic;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .price-input-wrapper {
        position: relative;
    }
    
    .currency-symbol {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #8b5a96;
        font-weight: 700;
        font-size: 1.1rem;
        z-index: 1;
    }
    
    .price-input {
        padding-left: 45px !important;
    }
    
    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 50%;
        background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .quantity-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
    }
    
    .quantity-input {
        width: 80px;
        text-align: center;
        font-weight: 700;
        color: #6b4c7a;
    }
    
    @media (max-width: 768px) {
        .edit-container {
            padding: 1rem;
        }
        
        .form-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .form-control-custom {
            padding: 12px 15px;
        }
        
        .has-icon .form-control-custom,
        .has-icon .form-select-custom {
            padding-left: 40px;
        }
        
        .input-icon {
            left: 12px;
            font-size: 1rem;
        }
        
        .quantity-controls {
            justify-content: center;
        }
    }
    
    .sparkle-decoration {
        position: absolute;
        color: rgba(255, 182, 193, 0.4);
        font-size: 1.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    .sparkle-1 { top: 10%; right: 10%; animation-delay: 0s; }
    .sparkle-2 { top: 70%; left: 10%; animation-delay: 0.7s; }
    .sparkle-3 { top: 40%; right: 5%; animation-delay: 1.4s; }
    
    @keyframes sparkle {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.2); }
    }
</style>

<div class="edit-container">
    {{-- ✨ Decorative Sparkles --}}
    <div class="sparkle-decoration sparkle-1">✨</div>
    <div class="sparkle-decoration sparkle-2">💫</div>
    <div class="sparkle-decoration sparkle-3">🌟</div>
    
    {{-- 🔙 Back Link --}}
    <a href="{{ route('admin.order_items.index') }}" class="back-link">
        <span>💕</span>
        Back to Order Items
    </a>
    
    <div class="form-card">
        <h2 class="page-title">
            <span>✨</span>
            Edit Order Item
            <span>🛍️</span>
        </h2>
        
        <form action="{{ route('admin.order_items.update', $order_item->id) }}" method="POST">
            @csrf 
            @method('PUT')
            
            <div class="form-group has-icon">
                <label for="order_id" class="form-label">
                    <span>📋</span>
                    Order
                </label>
                <div class="select-wrapper">
                    <select name="order_id" 
                            id="order_id"
                            class="form-control-custom form-select-custom">
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}" @selected($order->id == $order_item->order_id)>
                                📦 Order #{{ $order->id }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-icon">📋</div>
                </div>
                <div class="form-hint">
                    <span>💭</span>
                    Select the order this item belongs to
                </div>
            </div>
            
            <div class="form-group has-icon">
                <label for="product_id" class="form-label">
                    <span>🛍️</span>
                    Product
                </label>
                <div class="select-wrapper">
                    <select name="product_id" 
                            id="product_id"
                            class="form-control-custom form-select-custom">
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" @selected($product->id == $order_item->product_id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-icon">🛍️</div>
                </div>
                <div class="form-hint">
                    <span>✨</span>
                    Choose the product for this order item
                </div>
            </div>
            
            <div class="form-group">
                <label for="quantity" class="form-label">
                    <span>📦</span>
                    Quantity
                </label>
                <div class="quantity-controls">
                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">−</button>
                    <input type="number" 
                           name="quantity" 
                           id="quantity"
                           class="form-control-custom quantity-input" 
                           value="{{ $order_item->quantity }}"
                           min="1"
                           required>
                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                </div>
                <div class="form-hint">
                    <span>🔢</span>
                    Set the quantity for this item
                </div>
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">
                    <span>💰</span>
                    Price
                </label>
                <div class="price-input-wrapper">
                    <span class="currency-symbol">$</span>
                    <input type="number" 
                           name="price" 
                           id="price"
                           class="form-control-custom price-input" 
                           value="{{ $order_item->price }}"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           required>
                </div>
                <div class="form-hint">
                    <span>💎</span>
                    Enter the price for this item
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <span>💅</span>
                Update Order Item
                <span>✨</span>
            </button>
        </form>
    </div>
</div>

<script>
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value) || 0;
    quantityInput.value = currentValue + 1;
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value) || 0;
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}
</script>

@endsection