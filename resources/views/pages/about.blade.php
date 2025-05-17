@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <section class="hero">
        <div class="hero-text">
            <h1>Creating Magic, One Bear at a Time</h1>
            <p>Personalized teddies made with love and magic, designed to bring joy to every hug.</p>
            <button class="cta-btn">✨ Start Customizing</button>
        </div>
        <img src="{{ asset('images/teddy-shop.png') }}" alt="Teddy Bear Shop">
    </section>

    <section class="story">
        <h2>Our Magical Story</h2>
        <div class="story-container">
            <div class="story-box">
                <h3>💖 The Dream</h3>
                <p>A vision to create the softest, most magical teddy bears.</p>
            </div>
            <div class="story-box">
                <h3>🌟 The Journey</h3>
                <p>Handcrafted with love and personalized for every hug.</p>
            </div>
            <div class="story-box">
                <h3>✨ The Magic</h3>
                <p>Every teddy tells a story and spreads happiness.</p>
            </div>
        </div>
    </section>

    <section class="mission">
        <h2>Our Mission</h2>
        <p>To create the most magical, soft, and lovable teddies, making every hug full of joy, warmth, and comfort.</p>
    </section>

    <section class="team">
        <h2>Meet Our Magic Makers</h2>
        <div class="team-container">
            <div class="team-member">
                <img src="{{ asset('images/person3.jpeg') }}" alt="Team Member">
                <p>Emma - Lead Designer</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('images/person2.jpg') }}" alt="Team Member">
                <p>Sarah - Product Manager</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('images/person1.jpg') }}" alt="Team Member">
                <p>James - Teddy Specialist</p>
            </div>
        </div>
    </section>

    <section class="why-choose">
        <h2>Why Choose HugsyWugsy?</h2>
        <div class="why-container">
            <div class="why-box">
                <h3>🌸 Handmade Quality</h3>
                <p>Each teddy is handcrafted with care and attention.</p>
            </div>
            <div class="why-box">
                <h3>💖 Personalized for You</h3>
                <p>Choose colors, accessories, and special embroidery.</p>
            </div>
            <div class="why-box">
                <h3>🎁 The Perfect Gift</h3>
                <p>Great for birthdays, anniversaries, and special moments.</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Ready to Create Your Perfect Teddy Bear?</h2>
        <button class="cta-btn" style="align-items: center;">🧸 Start Designing Now!</button>
    </section>
@endsection
