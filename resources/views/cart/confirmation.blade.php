@extends('layouts.app')

@section('title', 'Thank You for Your Order!')

@section('content')
<style>
    .thankyou-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #fdf2f8 0%, #fef7f7 25%, #faf5ff 50%, #f0f9ff 75%, #fdf2f8 100%);
        padding: 3rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .thankyou-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 20%, rgba(244, 114, 182, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(168, 85, 247, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 60%, rgba(251, 113, 133, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .thankyou-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 1;
    }
    
    .thankyou-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        border-radius: 2.5rem;
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(255, 255, 255, 0.5);
        border: 2px solid #fbcfe8;
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .thankyou-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #f472b6, #fb7185, #a855f7, #f472b6);
        background-size: 200% 100%;
        animation: shimmer 3s ease-in-out infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    .thankyou-title {
        font-size: 3.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #ec4899, #fb7185, #a855f7, #ec4899);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 8px rgba(236, 72, 153, 0.3);
        animation: gradientShift 4s ease-in-out infinite;
        line-height: 1.2;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .thankyou-subtitle {
        font-size: 1.4rem;
        color: #be185d;
        margin-bottom: 2.5rem;
        line-height: 1.6;
        font-weight: 500;
        text-shadow: 0 2px 4px rgba(190, 24, 93, 0.2);
    }
    
    .order-summary-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(253, 242, 248, 0.9));
        border-radius: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 2px solid #f9a8d4;
        margin-bottom: 2.5rem;
        overflow: hidden;
        position: relative;
    }
    
    .order-summary-card::after {
        content: '✨';
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.5rem;
        opacity: 0.4;
        animation: twinkle 2s ease-in-out infinite;
    }
    
    @keyframes twinkle {
        0%, 100% { opacity: 0.4; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }
    
    .card-header {
        background: linear-gradient(135deg, #f472b6, #fb7185, #a855f7);
        color: white;
        padding: 1.5rem;
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        animation: headerShine 3s ease-in-out infinite;
    }
    
    @keyframes headerShine {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .card-header h5 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: bold;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }
    
    .card-body {
        background: linear-gradient(135deg, #fffafc, #fef7f7);
        padding: 2rem;
        position: relative;
    }
    
    .order-items {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }
    
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        margin-bottom: 0.5rem;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 1rem;
        border: 1px solid #fce7f3;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .order-item:hover {
        transform: translateX(10px);
        box-shadow: 0 8px 25px rgba(244, 114, 182, 0.15);
        background: rgba(255, 255, 255, 0.9);
    }
    
    .order-item::before {
        content: '🧸';
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .order-item:hover::before {
        left: 10px;
        opacity: 1;
    }
    
    .order-item:hover .item-name {
        padding-left: 2rem;
    }
    
    .item-name {
        font-weight: 600;
        color: #be185d;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .item-details {
        color: #c71585;
        font-weight: 500;
        font-size: 1rem;
    }
    
    .total-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px dashed #f9a8d4;
        text-align: right;
    }
    
    .total-amount {
        color: #be185d;
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 0 2px 4px rgba(190, 24, 93, 0.2);
        background: linear-gradient(135deg, #fce7f3, #fff);
        padding: 1rem;
        border-radius: 1rem;
        display: inline-block;
        min-width: 150px;
        box-shadow: 0 4px 15px rgba(190, 24, 93, 0.1);
    }
    
    .no-items-message {
        color: #be185d;
        font-size: 1.2rem;
        font-style: italic;
        padding: 2rem;
    }
    
    .certificate-btn {
        background: linear-gradient(135deg, #fce7f3, #fff0f5);
        border: 3px dashed #f472b6;
        color: #be185d;
        border-radius: 2rem;
        padding: 1.2rem 2.5rem;
        font-size: 1.2rem;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 25px rgba(244, 114, 182, 0.2);
    }
    
    .certificate-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(244, 114, 182, 0.2), transparent);
        transition: left 0.6s;
    }
    
    .certificate-btn:hover::before {
        left: 100%;
    }
    
    .certificate-btn:hover {
        background: linear-gradient(135deg, #f9a8d4, #fce7f3);
        border-color: #be185d;
        color: #be185d;
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 35px rgba(244, 114, 182, 0.4);
        text-decoration: none;
    }
    
    .certificate-btn:active {
        transform: translateY(-2px) scale(1.02);
    }
    
    /* Floating decorations */
    .floating-hearts {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 2rem;
        opacity: 0.3;
        animation: floatHearts 4s ease-in-out infinite;
    }
    
    @keyframes floatHearts {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
        25% { transform: translateY(-10px) rotate(5deg); opacity: 0.6; }
        50% { transform: translateY(-5px) rotate(-3deg); opacity: 0.4; }
        75% { transform: translateY(-15px) rotate(8deg); opacity: 0.7; }
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .thankyou-container {
            padding: 0 0.5rem;
        }
        
        .thankyou-card {
            padding: 2rem 1.5rem;
        }
        
        .thankyou-title {
            font-size: 2.5rem;
        }
        
        .thankyou-subtitle {
            font-size: 1.2rem;
        }
        
        .certificate-btn {
            padding: 1rem 2rem;
            font-size: 1.1rem;
        }
        
        .order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>

<div class="thankyou-wrapper">
    <div class="thankyou-container">
        <div class="thankyou-card">
            <div class="floating-hearts">💕</div>
            
            <h1 class="thankyou-title">🎉 Thank You for Your Sweet Order! 🎉</h1>
            <p class="thankyou-subtitle">Your precious HugsyWugsy bear is being prepared with endless love, cuddles, and magical fluff! 🧸💖✨</p>
            
            <div class="order-summary-card">
                <div class="card-header">
                    <h5>💌 Your Adorable Order Summary</h5>
                </div>
                <div class="card-body">
                    @if($order && $order->items->count())
                        <ul class="order-items">
                            @foreach ($order->items as $item)
                                <li class="order-item">
                                    <span class="item-name">{{ $item->product->name }}</span>
                                    <span class="item-details">{{ $item->quantity }} × ${{ number_format($item->price, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total-section">
                            <div class="total-amount">
                                ✨ Total: ${{ number_format($order->total, 2) }} ✨
                            </div>
                        </div>
                    @else
                        <p class="no-items-message">No precious items found in this order. 🥺</p>
                    @endif
                </div>
            </div>
            
            <a href="{{ route('pages.certificate') }}" class="certificate-btn">
                📄 Download Your Bear Adoption Certificate 🎀
            </a>
        </div>
    </div>
</div>
@endsection