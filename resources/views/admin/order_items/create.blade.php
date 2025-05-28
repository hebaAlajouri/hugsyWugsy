@extends('layouts.admin')

@section('content')
<style>
    .girly-container {
        background: linear-gradient(135deg, #ffeef8 0%, #fff5f9 50%, #fef7ff 100%);
        min-height: 100vh;
        padding: 2rem 0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .girly-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(236, 72, 153, 0.1);
        border: 1px solid rgba(244, 114, 182, 0.1);
        max-width: 500px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
    }
    
    .girly-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #ec4899, #f472b6, #f9a8d4, #fce7f3);
    }
    
    .girly-header {
        padding: 2.5rem 2rem 1rem;
        text-align: center;
        position: relative;
    }
    
    .girly-header::after {
        content: '✨';
        position: absolute;
        top: 1rem;
        right: 2rem;
        font-size: 1.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    .girly-title {
        color: #be185d;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.025em;
    }
    
    .girly-subtitle {
        color: #ec4899;
        font-size: 0.95rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }
    
    .girly-form {
        padding: 0 2rem 2.5rem;
    }
    
    .girly-field {
        margin-bottom: 1.75rem;
        position: relative;
    }
    
    .girly-label {
        display: block;
        color: #831843;
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        letter-spacing: 0.01em;
    }
    
    .girly-input, .girly-select {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #fce7f3;
        border-radius: 16px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(253, 242, 248, 0.5);
        color: #831843;
        font-weight: 500;
    }
    
    .girly-input:focus, .girly-select:focus {
        outline: none;
        border-color: #ec4899;
        box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-1px);
    }
    
    .girly-input::placeholder {
        color: #d946ef;
        opacity: 0.6;
    }
    
    .girly-select option {
        background: #fdf2f8;
        color: #831843;
        padding: 0.5rem;
    }
    
    .btn-hugsy {
        width: 100%;
        background: linear-gradient(135deg, #ec4899 0%, #f472b6 50%, #be185d 100%);
        border: none;
        color: white;
        padding: 1.25rem 2rem;
        border-radius: 16px;
        font-size: 1.1rem;
        font-weight: 700;
        letter-spacing: 0.025em;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        margin-top: 1rem;
    }
    
    .btn-hugsy:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(236, 72, 153, 0.3);
    }
    
    .btn-hugsy:active {
        transform: translateY(0);
    }
    
    .btn-hugsy::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-hugsy:hover::before {
        left: 100%;
    }
    
    .floating-hearts {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }
    
    .heart {
        position: absolute;
        color: #f9a8d4;
        font-size: 1.5rem;
        animation: float 8s ease-in-out infinite;
        opacity: 0.3;
    }
    
    .heart:nth-child(1) { left: 10%; animation-delay: 0s; }
    .heart:nth-child(2) { left: 20%; animation-delay: 2s; }
    .heart:nth-child(3) { left: 80%; animation-delay: 4s; }
    .heart:nth-child(4) { left: 90%; animation-delay: 6s; }
    
    @keyframes sparkle {
        0%, 100% { transform: rotate(0deg) scale(1); opacity: 0.7; }
        50% { transform: rotate(10deg) scale(1.2); opacity: 1; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10%, 90% { opacity: 0.3; }
        50% { transform: translateY(-10vh) rotate(180deg); opacity: 0.6; }
    }
    
    /* Mobile responsiveness */
    @media (max-width: 640px) {
        .girly-container {
            padding: 1rem;
        }
        
        .girly-card {
            margin: 0 1rem;
        }
        
        .girly-header {
            padding: 2rem 1.5rem 1rem;
        }
        
        .girly-form {
            padding: 0 1.5rem 2rem;
        }
        
        .girly-title {
            font-size: 1.75rem;
        }
    }
</style>

<div class="girly-container">
    <div class="floating-hearts">
        <div class="heart">💖</div>
        <div class="heart">💕</div>
        <div class="heart">💗</div>
        <div class="heart">💝</div>
    </div>
    
    <div class="girly-card">
        <div class="girly-header">
            <h2 class="girly-title">Create Order Item</h2>
            <p class="girly-subtitle">Add a beautiful new item to your order</p>
        </div>
        
        <form action="{{ route('admin.order_items.store') }}" method="POST" class="girly-form">
            @csrf
            
            <div class="girly-field">
                <label class="girly-label">✨ Select Order</label>
                <select name="order_id" class="girly-select" required>
                    <option value="">Choose an order...</option>
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="girly-field">
                <label class="girly-label">🌸 Select Product</label>
                <select name="product_id" class="girly-select" required>
                    <option value="">Choose a product...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="girly-field">
                <label class="girly-label">💫 Quantity</label>
                <input type="number" 
                       name="quantity" 
                       class="girly-input" 
                       placeholder="How many items?"
                       min="1" 
                       required>
            </div>
            
            <div class="girly-field">
                <label class="girly-label">💎 Price</label>
                <input type="text" 
                       name="price" 
                       class="girly-input" 
                       placeholder="Enter the price..."
                       required>
            </div>
            
            <button type="submit" class="btn-hugsy">
                Save Order Item 💕
            </button>
        </form>
    </div>
</div>
@endsection