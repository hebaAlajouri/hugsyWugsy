@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-0" style="border-radius: 30px;">
                <div class="card-header text-center py-5" style="background: linear-gradient(135deg, #FFD1DC 0%, #FF85A1 100%); border-radius: 30px 30px 0 0;">
                    <div class="ribbon-container">
                        <div class="ribbon ribbon-left"></div>
                        <h1 class="mb-0 fw-bold text-white fancy-title">✨ Customize Your Bear ✨</h1>
                        <div class="ribbon ribbon-right"></div>
                    </div>
                </div>
                <div class="card-body p-5" style="background-color: #FFF0F5;">
                    <form action="{{ route('pages.customizer.store') }}" method="POST">
                        @csrf

                        <!-- Bear Color -->
                        <div class="mb-5">
                            <h3 class="section-title text-center mb-4">
                                <i class="fas fa-palette me-2"></i>Choose Bear Color
                            </h3>
                            <div class="d-flex gap-4 flex-wrap justify-content-center">
                                @foreach(['pink', 'blue', 'yellow'] as $color)
                                    <label class="color-option-card">
                                        <input type="radio" name="color" value="{{ $color }}" class="d-none" required>
                                        <div class="color-circle color-{{ $color }}">
                                            <div class="inner-circle">
                                                <span class="color-icon">
                                                    <i class="fas fa-heart"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="color-name">{{ ucfirst($color) }}</div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="fancy-divider">
                            <div class="divider-line"></div>
                            <div class="divider-icon">🧸</div>
                            <div class="divider-line"></div>
                        </div>

                        <!-- Accessories -->
                        <div class="mb-5">
                            <h3 class="section-title text-center mb-4">
                                <i class="fas fa-star me-2"></i>Select Accessories
                            </h3>
                            <div class="d-flex gap-4 flex-wrap justify-content-center">
                                @foreach(['bow-tie', 'heart', 'crown'] as $accessory)
                                    <label class="accessory-option">
                                        <input type="checkbox" name="accessories[]" value="{{ $accessory }}" class="d-none">
                                        <div class="accessory-circle">
                                            <div class="accessory-icon">
                                                @if($accessory == 'bow-tie')
                                                    <i class="fas fa-ribbon"></i>
                                                @elseif($accessory == 'heart')
                                                    <i class="fas fa-heart"></i>
                                                @elseif($accessory == 'crown')
                                                    <i class="fas fa-crown"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="accessory-name">{{ ucfirst(str_replace('-', ' ', $accessory)) }}</div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="fancy-divider">
                            <div class="divider-line"></div>
                            <div class="divider-icon">💕</div>
                            <div class="divider-line"></div>
                        </div>

                        <div class="row">
                            <!-- Embroidery Text -->
                            <div class="col-md-6 mb-4">
                                <label for="text" class="form-label fancy-label">
                                    <i class="fas fa-heart me-2"></i>Embroidery Text
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text fancy-input-icon"><i class="fas fa-heart"></i></span>
                                    <input type="text" name="text" id="text" class="form-control fancy-input" maxlength="20" placeholder="e.g., I Love You">
                                </div>
                                <div class="form-text text-center">Max 20 characters</div>
                            </div>

                            <!-- Voice Recording ID Input -->
                            <div class="col-md-6 mb-4">
                                <label for="voice_recording_id" class="form-label fancy-label">
                                    <i class="fas fa-music me-2"></i>Voice Recording ID
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text fancy-input-icon"><i class="fas fa-music"></i></span>
                                    <input type="number" name="voice_recording_id" id="voice_recording_id" class="form-control fancy-input" placeholder="Enter voice recording ID">
                                </div>
                                <div class="form-text text-center">Optional</div>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <div class="mb-5">
                            <label for="special_instructions" class="form-label fancy-label">
                                <i class="fas fa-magic me-2"></i>Special Instructions
                            </label>
                            <textarea name="special_instructions" id="special_instructions" class="form-control fancy-input" maxlength="255" rows="3" placeholder="Any special requests for your bear..."></textarea>
                            <div class="form-text text-center">Optional, max 255 characters</div>
                        </div>

                        <!-- Product ID -->
                        <input type="hidden" name="product_id" value="{{ $product->id ?? 1 }}">

                        <div class="d-grid gap-3 mt-5">
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg fw-bold fancy-button pulsate">
                                <i class="fas fa-heart me-2"></i>Save My Beary Special Design
                            </button>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex gap-3">
                                <a href="{{ route('pages.voice_recording') }}" class="btn btn-outline-pink flex-grow-1 fancy-outline-button">
                                    <i class="fas fa-microphone me-1"></i>Record Voice
                                </a>
                                <a href="{{ route('voice.messages.index') }}" class="btn btn-outline-pink flex-grow-1 fancy-outline-button">
                                    <i class="fas fa-list me-1"></i>Voice Messages
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle bear color selection
    document.querySelectorAll('.color-option-card').forEach(card => {
        card.addEventListener('click', function () {
            document.querySelectorAll('input[name="color"]').forEach(radio => radio.checked = false);
            this.querySelector('input[type="radio"]').checked = true;

            document.querySelectorAll('.color-option-card').forEach(c => {
                c.classList.remove('selected');
            });
            
            this.classList.add('selected');
        });
    });

    // Toggle accessory selection
    document.querySelectorAll('.accessory-option').forEach(option => {
        option.addEventListener('click', function () {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                this.classList.add('selected');
            } else {
                this.classList.remove('selected');
            }
            
            console.log('Checkbox ' + checkbox.value + ' is now ' + (checkbox.checked ? 'checked' : 'unchecked'));
        });
    });

    // Initialize selected states on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add sparkles and floating hearts to the page
        createSparkles();
        createFloatingHearts();
        
        // Set initial state for radio buttons
        const selectedColor = document.querySelector('input[name="color"]:checked');
        if (selectedColor) {
            const card = selectedColor.closest('.color-option-card');
            card.classList.add('selected');
        }
        
        // Set initial state for checkboxes
        document.querySelectorAll('input[name="accessories[]"]:checked').forEach(checkbox => {
            const option = checkbox.closest('.accessory-option');
            option.classList.add('selected');
        });
    });
    
    // Create sparkle animation
    function createSparkles() {
        const sparkleContainer = document.createElement('div');
        sparkleContainer.className = 'sparkle-container';
        document.body.appendChild(sparkleContainer);
        
        for (let i = 0; i < 30; i++) {
            setTimeout(() => {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.style.left = Math.random() * 100 + 'vw';
                sparkle.style.top = Math.random() * 100 + 'vh';
                sparkle.style.animationDelay = Math.random() * 5 + 's';
                sparkleContainer.appendChild(sparkle);
            }, i * 300);
        }
    }
    
    // Create floating hearts animation
    function createFloatingHearts() {
        const heartsContainer = document.createElement('div');
        heartsContainer.className = 'hearts-container';
        document.body.appendChild(heartsContainer);
        
        for (let i = 0; i < 20; i++) {
            setTimeout(() => {
                const heart = document.createElement('div');
                heart.className = 'floating-heart';
                heart.style.left = Math.random() * 100 + 'vw';
                heart.style.bottom = '-20px';
                heart.style.opacity = 0.1 + Math.random() * 0.5;
                heart.style.fontSize = 10 + Math.random() * 20 + 'px';
                heart.style.animationDuration = 10 + Math.random() * 20 + 's';
                heart.style.animationDelay = Math.random() * 5 + 's';
                heart.innerHTML = '❤️';
                heartsContainer.appendChild(heart);
            }, i * 500);
        }
    }
</script>

<style>
    /* Enhanced girly color variables */
    :root {
        --pink-lightest: #FFF0F5;
        --pink-light: #FFD1DC;
        --pink-medium: #FF9EBB;
        --pink-dark: #FF85A1;
        --purple-light: #E0BBE4;
        --purple-medium: #C8A2C8;
        --lavender: #CCCCFF;
        --baby-blue: #BFEFFF;
        --pastel-yellow: #FFFACD;
    }
    
    body {
        background-color: #FFF9FB !important;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff9ebb' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        font-family: 'Quicksand', 'Arial Rounded MT Bold', sans-serif;
    }

    /* Fancy title with ribbons */
    .fancy-title {
        font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive;
        font-size: 2.5rem;
        letter-spacing: 1px;
        text-shadow: 3px 3px 6px rgba(0,0,0,0.2);
        position: relative;
        z-index: 10;
    }
    
    .ribbon-container {
        position: relative;
        display: inline-block;
        padding: 0 20px;
    }
    
    .ribbon {
        position: absolute;
        top: 50%;
        width: 40px;
        height: 80px;
        background-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%);
    }
    
    .ribbon-left {
        left: -25px;
        border-radius: 40px 0 0 40px;
    }
    
    .ribbon-right {
        right: -25px;
        border-radius: 0 40px 40px 0;
    }

    /* Section titles */
    .section-title {
        font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive;
        color: var(--pink-dark);
        font-size: 1.8rem;
        text-align: center;
        position: relative;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(255, 133, 161, 0.3);
    }
    
    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--pink-medium), transparent);
        transform: translateX(-50%);
        border-radius: 10px;
    }

    /* Fancy divider */
    .fancy-divider {
        display: flex;
        align-items: center;
        margin: 40px 0;
    }
    
    .divider-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--pink-medium), transparent);
    }
    
    .divider-icon {
        font-size: 30px;
        margin: 0 15px;
        filter: drop-shadow(0 2px 3px rgba(0,0,0,0.1));
    }

    /* Color option styling */
    .color-option-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        padding: 20px;
        border-radius: 20px;
    }
    
    .color-option-card:hover {
        transform: translateY(-10px) rotate(5deg);
    }
    
    .color-option-card.selected {
        background: linear-gradient(135deg, rgba(255,209,220,0.4) 0%, rgba(255,158,187,0.2) 100%);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 133, 161, 0.2);
    }
    
    .color-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1), inset 0 -5px 10px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .color-pink {
        background: radial-gradient(circle, #FFB6C1 0%, #FF69B4 100%);
    }
    
    .color-blue {
        background: radial-gradient(circle, #ADD8E6 0%, #87CEFA 100%);
    }
    
    .color-yellow {
        background: radial-gradient(circle, #FFFACD 0%, #FFEB3B 100%);
    }
    
    .inner-circle {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .color-icon {
        font-size: 40px;
        color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .color-option-card:hover .inner-circle,
    .color-option-card.selected .inner-circle {
        transform: scale(1.1);
        background-color: rgba(255, 255, 255, 0.8);
    }
    
    .color-option-card:hover .color-icon,
    .color-option-card.selected .color-icon {
        transform: scale(1.2);
    }
    
    .color-name {
        font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive;
        font-size: 1.2rem;
        color: var(--pink-dark);
        font-weight: bold;
        margin-top: 10px;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
    }

    /* Accessory option styling */
    .accessory-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px;
        cursor: pointer;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        padding: 15px;
        border-radius: 20px;
    }
    
    .accessory-option:hover {
        transform: translateY(-8px) rotate(3deg);
    }
    
    .accessory-option.selected {
        background: linear-gradient(135deg, rgba(255,209,220,0.4) 0%, rgba(255,158,187,0.2) 100%);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 133, 161, 0.2);
    }
    
    .accessory-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--purple-light) 0%, var(--lavender) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1), inset 0 -5px 10px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .accessory-icon {
        font-size: 40px;
        color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .accessory-option:hover .accessory-circle,
    .accessory-option.selected .accessory-circle {
        transform: scale(1.1);
        background: linear-gradient(135deg, var(--pink-medium) 0%, var(--purple-light) 100%);
    }
    
    .accessory-option:hover .accessory-icon,
    .accessory-option.selected .accessory-icon {
        transform: scale(1.2);
    }
    
    .accessory-name {
        font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive;
        font-size: 1.1rem;
        color: var(--pink-dark);
        font-weight: bold;
        margin-top: 10px;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
    }

    /* Fancy label */
    .fancy-label {
        font-family: 'Comic Sans MS', 'Bubblegum Sans', cursive;
        color: var(--pink-dark);
        font-size: 1.3rem;
        position: relative;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 15px;
        text-shadow: 1px 1px 2px rgba(255, 133, 161, 0.3);
    }
    
    .fancy-label:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--pink-medium), transparent);
        border-radius: 50%;
    }
    
    /* Fancy inputs */
    .fancy-input {
        border-radius: 20px;
        border: 2px solid var(--pink-light);
        background-color: white;
        transition: all 0.3s ease;
        padding: 12px 20px;
        font-size: 1.1rem;
    }
    
    .fancy-input:focus {
        border-color: var(--pink-medium);
        box-shadow: 0 0 0 0.25rem rgba(255, 158, 187, 0.25);
        transform: translateY(-2px);
    }
    
    .fancy-input-icon {
        background: linear-gradient(135deg, var(--pink-light) 0%, var(--pink-medium) 100%);
        border: none;
        color: white;
        border-radius: 20px 0 0 20px;
    }
    
    /* Button styling */
    .fancy-button {
        background: linear-gradient(135deg, var(--pink-medium) 0%, var(--pink-dark) 100%);
        border: none;
        color: white;
        border-radius: 30px;
        padding: 15px 30px;
        font-size: 1.2rem;
        box-shadow: 0 8px 20px rgba(255, 133, 161, 0.4);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .fancy-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(255, 133, 161, 0.5);
        color: white;
    }
    
    .fancy-button:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: all 0.5s ease;
        z-index: -1;
    }
    
    .fancy-button:hover:before {
        left: 100%;
    }
    
    .pulsate {
        animation: pulsate 2s infinite;
    }
    
    @keyframes pulsate {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 133, 161, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 133, 161, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 133, 161, 0);
        }
    }
    
    .fancy-outline-button {
        color: var(--pink-dark);
        border: 3px dashed var(--pink-medium);
        border-radius: 30px;
        padding: 12px 20px;
        background-color: rgba(255, 209, 220, 0.1);
        transition: all 0.3s ease;
        font-weight: bold;
        position: relative;
        overflow: hidden;
    }
    
    .fancy-outline-button:hover {
        background-color: rgba(255, 209, 220, 0.3);
        color: var(--pink-dark);
        transform: translateY(-3px);
        border-style: solid;
        box-shadow: 0 5px 15px rgba(255, 133, 161, 0.2);
    }
    
    /* Sparkle animation */
    .sparkle-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9999;
        overflow: hidden;
    }
    
    .sparkle {
        position: absolute;
        width: 8px;
        height: 8px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23FF9EBB' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'%3E%3C/polygon%3E%3C/svg%3E");
        background-size: contain;
        opacity: 0;
        animation: sparkle 5s infinite linear;
    }
    
    @keyframes sparkle {
        0% {
            transform: scale(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.8;
        }
        20% {
            transform: scale(1.2) rotate(45deg);
            opacity: 1;
        }
        40% {
            transform: scale(0.8) rotate(90deg);
            opacity: 0.8;
        }
        60% {
            transform: scale(1) rotate(135deg);
            opacity: 1;
        }
        80% {
            transform: scale(1.2) rotate(180deg);
            opacity: 0.8;
        }
        100% {
            transform: scale(0) rotate(225deg);
            opacity: 0;
        }
    }
    
    /* Floating hearts animation */
    .hearts-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9998;
        overflow: hidden;
    }
    
    .floating-heart {
        position: absolute;
        font-size: 15px;
        animation: float-up 15s linear infinite;
    }
    
    @keyframes float-up {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.8;
        }
        90% {
            opacity: 0.8;
        }
        100% {
            transform: translateY(-100vh) rotate(360deg);
            opacity: 0;
        }
    }
</style>
@endpush
@endsection