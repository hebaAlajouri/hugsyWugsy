@extends('layouts.app')

@section('content')
<style>
    .checkout-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #fdf2f8 0%, #fef7f7 50%, #faf5ff 100%);
        padding: 2rem 0;
    }
    
    .checkout-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .checkout-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        border: 2px solid #fbcfe8;
        padding: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .checkout-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(to right, #f472b6, #fb7185, #a855f7);
    }
    
    .checkout-title {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(to right, #ec4899, #fb7185, #a855f7);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 2rem;
        text-align: center;
        text-shadow: 0 2px 10px rgba(236, 72, 153, 0.3);
    }
    
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-label {
        color: #be185d;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
        display: block;
        text-shadow: 0 1px 3px rgba(190, 24, 93, 0.2);
    }
    
    .form-input {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #fbcfe8;
        border-radius: 1.5rem;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .form-input:focus {
        outline: none;
        border-color: #f472b6;
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2), 0 8px 15px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-2px);
    }
    
    .form-input:hover {
        border-color: #f9a8d4;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }
    
    .form-textarea {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #fbcfe8;
        border-radius: 1.5rem;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }
    
    .form-textarea:focus {
        outline: none;
        border-color: #f472b6;
        box-shadow: 0 0 0 3px rgba(244, 114, 182, 0.2), 0 8px 15px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-2px);
    }
    
    .form-textarea:hover {
        border-color: #f9a8d4;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
    }
    
    .payment-input {
        background: linear-gradient(135deg, #fef7f7, #fdf2f8) !important;
        color: #be185d !important;
        font-weight: 600;
        cursor: not-allowed;
    }
    
    .divider {
        border: none;
        height: 2px;
        background: linear-gradient(to right, transparent, #f9a8d4, transparent);
        margin: 2.5rem 0;
        position: relative;
    }
    
    .divider::after {
        content: '✨';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 0.5rem;
        font-size: 1.2rem;
    }
    
    .summary-title {
        color: #be185d;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 0 1px 3px rgba(190, 24, 93, 0.2);
    }
    
    .order-summary {
        background: linear-gradient(135deg, #fef7f7, #fdf2f8);
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 2px solid #fbcfe8;
        margin-bottom: 2rem;
    }
    
    .order-item {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f9a8d4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.5);
    }
    
    .order-item:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateX(5px);
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .item-name {
        color: #374151;
        font-weight: 500;
        font-size: 1.1rem;
    }
    
    .item-price {
        color: #be185d;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .total-item {
        background: linear-gradient(135deg, #ffe4e1, #fce7f3) !important;
        font-weight: bold;
        font-size: 1.2rem;
        border-top: 2px solid #f9a8d4;
    }
    
    .total-label {
        color: #374151;
    }
    
    .total-price {
        color: #be185d;
        font-size: 1.4rem;
        text-shadow: 0 1px 3px rgba(190, 24, 93, 0.2);
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #f472b6, #fb7185, #a855f7);
        color: white;
        border: none;
        border-radius: 2rem;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(244, 114, 182, 0.4);
        display: block;
        margin: 0 auto;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
    }
    
    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }
    
    .submit-btn:hover::before {
        left: 100%;
    }
    
    .submit-btn:hover {
        background: linear-gradient(135deg, #ec4899, #f43f5e, #9333ea);
        box-shadow: 0 15px 35px rgba(244, 114, 182, 0.6);
        transform: translateY(-3px) scale(1.05);
    }
    
    .submit-btn:active {
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 8px 20px rgba(244, 114, 182, 0.4);
    }
    
    /* Floating hearts animation */
    .checkout-card::after {
        content: '💕';
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 2rem;
        opacity: 0.3;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(5deg); }
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .checkout-container {
            padding: 1rem;
        }
        
        .checkout-card {
            padding: 2rem 1.5rem;
        }
        
        .checkout-title {
            font-size: 2rem;
        }
        
        .submit-btn {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }
    }
</style>

<div class="checkout-wrapper">
    <div class="checkout-container">
        <div class="checkout-card">
            <h2 class="checkout-title">💖 Sweetest Checkout 💖</h2>
            
            <form action="{{ route('checkout.submit') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="shipping_address" class="form-label">📦 Your Sweet Delivery Address</label>
                    <input type="text" name="shipping_address" id="shipping_address" class="form-input" required placeholder="Where should we deliver your adorable bears? 🏠">
                </div>
                
                <div class="form-group">
                    <label class="form-label">💰 Payment Method</label>
                    <input type="text" value="Cash on Delivery 💵" class="form-input payment-input" disabled>
                </div>
                
                <div class="form-group">
                    <label for="note" class="form-label">📝 Special Note for Your Cuties (Optional)</label>
                    <textarea name="note" id="note" class="form-textarea" placeholder="Any special instructions or sweet messages for your teddy bears? 🧸💕"></textarea>
                </div>
                
                <hr class="divider">
                
                <h5 class="summary-title">🧸 Your Adorable Order Summary 🧸</h5>
                <div class="order-summary">
                    @foreach($order->items as $item)
                        <div class="order-item">
                            <span class="item-name">{{ $item->product->name }} (x{{ $item->quantity }}) 🧸</span>
                            <span class="item-price">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="order-item total-item">
                        <span class="total-label">✨ Total Cuteness Value:</span>
                        <span class="total-price">${{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</span>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    ✅ Place My Sweet Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection