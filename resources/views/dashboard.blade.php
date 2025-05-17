@extends('layouts.app')

@section('title', 'HugsyWugsy - Custom Teddy Bears')

@section('content')


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
<section class="happy-hugs">
    <h2>Happy Hugs</h2>
    <div class="testimonials-container">
        <div class="testimonial-card">
            <p class="testimonial-text">"Absolutely love my custom teddy! So soft and adorable!"</p>
            <p class="testimonial-author">- Sarah 💖</p>
        </div>
        <div class="testimonial-card">
            <p class="testimonial-text">"The perfect gift! My daughter loves her teddy so much!"</p>
            <p class="testimonial-author">- Hannah 🎀</p>
        </div>
        <div class="testimonial-card">
            <p class="testimonial-text">"Super cute and magical experience customizing my teddy!"</p>
            <p class="testimonial-author">- Lisa 🌸</p>
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
