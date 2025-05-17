@extends('layouts.app')

@section('title', 'Create a Gift Card | HugsyWugsy')

@section('content')
<div class="gift-card-container">
    <h1 class="title">🎀 Create Your Magical Gift Card 🎀</h1>

    {{-- Flash Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Gift Card Form --}}
    <form action="{{ route('pages.gift-cards.store') }}" method="POST">
        @csrf

        <!-- Live Preview -->
        <div class="preview-container">
            <div class="gift-card-preview">
                <img id="card-template" src="{{ asset('images/template1.jpg') }}" alt="Gift Card Template">
                <div class="preview-text">
                    <h2 id="preview-recipient">For: [Recipient]</h2>
                    <p id="preview-message">.......</p>
                    <h3 id="preview-sender">From: [Your Name]</h3>
                </div>
            </div>
        </div>

        <!-- Hidden input to store selected template -->
        <input type="hidden" name="template" id="template-selected" value="template1.jpg">

        <!-- Customization Form -->
        <div class="customization-form">

            <label>🎨 Choose a Template:</label>
            <div class="template-options">
                <img src="{{ asset('images/template1.jpg') }}" class="template-choice" onclick="changeTemplate('template1.jpg')">
                <img src="{{ asset('images/template2.jpg') }}" class="template-choice" onclick="changeTemplate('template2.jpg')">
                <img src="{{ asset('images/template3.jpg') }}" class="template-choice" onclick="changeTemplate('template3.jpg')">
            </div>

            <label>💌 Recipient's Name:</label>
            <input type="text" id="recipient-name" name="recipient_name" placeholder="Enter name..." oninput="updatePreview()" required>

            <label>💖 Message:</label>
            <textarea id="gift-message" name="message" placeholder="Write a sweet message..." oninput="updatePreview()" required></textarea>

            <label>🎀 From:</label>
            <input type="text" id="sender-name" name="sender_name" placeholder="Your name..." oninput="updatePreview()" required>

            <label>🖋 Font Style:</label>
            <select id="font-style" name="font_style" onchange="changeFontStyle()" required>
                <option value="Poppins">Poppins</option>
                <option value="Dancing Script">Dancing Script</option>
                <option value="Pacifico">Pacifico</option>
            </select>

            <label>🎁 Choose Gift Amount:</label>
            <select id="gift-amount" name="amount" required>
                <option value="10">\$10</option>
                <option value="25">\$25</option>
                <option value="50">\$50</option>
                <option value="100">\$100</option>
            </select>

            <label>📤 Delivery Method:</label>
            <select id="delivery-method" name="delivery_method" required>
                <option value="Email">Email</option>
                <option value="PDF">Print (Download as PDF)</option>
            </select>

            <button type="submit" class="generate-btn">✨ Generate Gift Card ✨</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/gift_card.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Pacifico&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/gift_card.js') }}" defer></script>
@endpush
