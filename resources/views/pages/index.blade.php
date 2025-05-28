@extends('layouts.app')

@section('title', 'HugsyWugsy - Custom Teddy Bears')

@section('content')

@push('styles')
<style>
    /* VOICE MESSAGES MAGIC SECTION */
.voice-magic {
    padding: 80px 20px;
    background: linear-gradient(135deg, #fff5f8 0%, #ffe8f1 50%, #fff0f5 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.voice-magic::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 182, 193, 0.1) 0%, transparent 70%);
    animation: gentleFloat 20s ease-in-out infinite;
    pointer-events: none;
}

.voice-magic h2 {
    font-size: 2.8rem;
    color:#E6399B;
    font-family: 'Poppins', sans-serif;
    font-size: 32px;
    margin-bottom: 15px;
    text-shadow: 0 2px 4px rgba(214, 86, 140, 0.1);
}

.section-subtitle {
    font-size: 1.3rem;
    color:#E6399B;
    margin-bottom: 60px;
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Voice Features Grid */
.voice-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
    max-width: 1000px;
    margin: 0 auto 80px auto;
    padding: 0 20px;
}

.voice-feature {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 8px 32px rgba(255, 182, 193, 0.2);
    border: 1px solid rgba(255, 182, 193, 0.3);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.voice-feature::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 182, 193, 0.1), transparent);
    transition: left 0.6s ease;
}

.voice-feature:hover::before {
    left: 100%;
}

.voice-feature:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 16px 48px rgba(255, 182, 193, 0.3);
    border-color: #ffb6c1;
}

.voice-icon {
    font-size: 3.5rem;
    background: linear-gradient(135deg, #ff99cc, #ffb6c1);
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px auto;
    box-shadow: 0 8px 24px rgba(255, 153, 204, 0.3);
    animation: gentlePulse 3s ease-in-out infinite;
    position: relative;
    z-index: 2;
}

.voice-feature h3 {
    font-size: 1.6rem;
    color: #d6568c;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
}

.voice-feature p {
    font-size: 1.1rem;
    color: #8a4a6b;
    line-height: 1.7;
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
    position: relative;
    z-index: 2;
}

/* Voice Demo Section */
.voice-demo {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(15px);
    border-radius: 30px;
    padding: 50px 40px;
    max-width: 500px;
    margin: 0 auto;
    box-shadow: 0 12px 40px rgba(255, 182, 193, 0.25);
    border: 2px solid rgba(255, 182, 193, 0.2);
    position: relative;
    overflow: hidden;
}

.voice-demo::before {
    content: '✨';
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 1.5rem;
    animation: sparkle 2s ease-in-out infinite;
}

.voice-demo img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 30px;
    box-shadow: 0 8px 24px rgba(255, 153, 204, 0.2);
    border: 4px solid #fff;
    animation: gentleBob 4s ease-in-out infinite;
}

.demo-btn {
    background: linear-gradient(135deg, #ff99cc 0%, #ffb6c1 50%, #ff99cc 100%);
    color: white;
    border: none;
    padding: 18px 40px;
    font-size: 1.2rem;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    box-shadow: 0 8px 24px rgba(255, 153, 204, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: none;
}

.demo-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
}

.demo-btn:hover::before {
    left: 100%;
}

.demo-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(255, 153, 204, 0.5);
    background: linear-gradient(135deg, #ff85c1 0%, #ffabc4 50%, #ff85c1 100%);
}

.demo-btn:active {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(255, 153, 204, 0.4);
}

/* Animations */
@keyframes gentleFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(-10px, -10px) rotate(1deg); }
    50% { transform: translate(10px, -5px) rotate(-1deg); }
    75% { transform: translate(-5px, 10px) rotate(0.5deg); }
}

@keyframes gentlePulse {
    0%, 100% { transform: scale(1); box-shadow: 0 8px 24px rgba(255, 153, 204, 0.3); }
    50% { transform: scale(1.05); box-shadow: 0 12px 32px rgba(255, 153, 204, 0.4); }
}

@keyframes gentleBob {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

@keyframes sparkle {
    0%, 100% { opacity: 0.7; transform: scale(1) rotate(0deg); }
    50% { opacity: 1; transform: scale(1.2) rotate(180deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .voice-magic {
        padding: 60px 15px;
    }
    
    .voice-magic h2 {
        font-size: 2.2rem;
        margin-bottom: 12px;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        margin-bottom: 40px;
        padding: 0 10px;
    }
    
    .voice-features {
        grid-template-columns: 1fr;
        gap: 30px;
        margin-bottom: 50px;
    }
    
    .voice-feature {
        padding: 30px 20px;
        border-radius: 20px;
    }
    
    .voice-icon {
        width: 70px;
        height: 70px;
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    
    .voice-feature h3 {
        font-size: 1.4rem;
        margin-bottom: 12px;
    }
    
    .voice-feature p {
        font-size: 1rem;
    }
    
    .voice-demo {
        padding: 35px 25px;
        border-radius: 25px;
        margin: 0 15px;
    }
    
    .voice-demo img {
        width: 100px;
        height: 100px;
        margin-bottom: 25px;
    }
    
    .demo-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
        border-radius: 40px;
    }
}

@media (max-width: 480px) {
    .voice-magic h2 {
        font-size: 1.9rem;
    }
    
    .section-subtitle {
        font-size: 1rem;
    }
    
    .voice-feature {
        padding: 25px 15px;
    }
    
    .voice-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .voice-feature h3 {
        font-size: 1.2rem;
    }
    
    .demo-btn {
        padding: 12px 25px;
        font-size: 1rem;
    }
}

/* Add magical floating elements */
.voice-magic::after {
    content: '🎵 💖 ✨ 🎀 🌟';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    font-size: 1.2rem;
    opacity: 0.3;
    animation: floatingElements 15s linear infinite;
    pointer-events: none;
    white-space: nowrap;
}

@keyframes floatingElements {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

</style>
@endpush
<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h1>Made to Hug, Meant to Love</h1>
        <p>Create your perfect cuddly companion with our magical teddy bear customization experience!</p>
        <button class="customize-btn">✨ Start Customizing</button>
    </div>
    <img src="{{ asset('images/teddy-hero.png') }}" alt="Cute Teddy Bear">
</section>

<!-- CUSTOMIZATION PREVIEW -->
<section class="customization">
    <h2>Design Your Dream Teddy</h2>
    <div class="custom-box">
        <img src="{{ asset('images/teddy-preview.png') }}" alt="Custom Teddy Preview">
        <div class="options">
            <h3>Choose Your Colors</h3>
            <div class="colors">
                <span class="color purple"></span>
                <span class="color pink"></span>
                <span class="color lavender"></span>
            </div>
            <h3>Add Accessories</h3>
            <div class="accessories">
                <button>🎀</button>
                <button>🧢</button>
                <button>🌸</button>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="our-promise">
    <h2>Our Promise to You</h2>
    <div class="promises">
        <div class="promise">
            <i class="fas fa-cut promise-icon"></i>
            <h3>Handmade with Love</h3>
            <p>Every teddy is crafted with care, ensuring it’s full of love and huggable moments.</p>
        </div>
        <div class="promise">
            <i class="fas fa-heart promise-icon"></i>
            <h3>Safe & Super Soft</h3>
            <p>We use only the safest, softest materials, making every hug feel extra special.</p>
        </div>
        <div class="promise">
            <i class="fas fa-shipping-fast promise-icon"></i>
            <h3>Fast & Reliable Delivery</h3>
            <p>Your custom teddy is made quickly and delivered safely, straight to your arms.</p>
        </div>
    </div>
</section>

<!-- HAPPY HUGS -->
<!-- VOICE MESSAGES MAGIC -->
<section class="voice-magic">
    <h2>Make Your Teddy Talk! 🎤</h2>
    <p class="section-subtitle">Record sweet messages that play from your teddy's heart</p>
    <div class="voice-features">
        <div class="voice-feature">
            <div class="voice-icon">🎵</div>
            <h3>Record Your Voice</h3>
            <p>Capture "I love you," lullabies, or any special message</p>
        </div>
        <div class="voice-feature">
            <div class="voice-icon">💝</div>
            <h3>Built-In Speaker</h3>
            <p>Hidden speaker plays your message with a gentle squeeze</p>
        </div>
        <div class="voice-feature">
            <div class="voice-icon">✨</div>
            <h3>Magical Moments</h3>
            <p>Create lasting memories with personalized audio hugs</p>
        </div>
    </div>
 
</section>

<!-- CALL TO ACTION -->
<section class="cta">
    <h2>Ready to Create Your Perfect Teddy?</h2>
    <p>Every bear is made with love and magic, just for you!</p>
    <button class="create-btn">💜 Create Your Teddy Now!</button>
</section>


@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
