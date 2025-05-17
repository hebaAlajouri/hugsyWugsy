@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow border-0 rounded-4" style="border-radius: 20px;">
                <div class="card-header text-center py-4" style="background: linear-gradient(135deg, #FFD1DC 0%, #FF9EBB 100%); border-radius: 20px 20px 0 0;">
                    <h1 class="mb-0 fw-bold text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.2); font-family: 'Comic Sans MS', cursive, sans-serif;">✨ Customize Your Bear ✨</h1>
                </div>
                <div class="card-body p-4" style="background-color: #FFF5F8;">
                    <form action="{{ route('pages.customizer.store') }}" method="POST">
                        @csrf

                        <!-- Bear Color -->
                        <div class="mb-5">
                            <label class="form-label fw-bold mb-3 curved-text">Select Bear Color</label>
                            <div class="d-flex gap-4 flex-wrap justify-content-center">
                                @foreach(['pink', 'blue', 'yellow'] as $color)
                                    <label class="text-center bear-color-option">
                                        <input type="radio" name="color" value="{{ $color }}" class="d-none" required>
                                        <div class="color-option-container">
                                            <img src="/images/bears/{{ $color }}.png" alt="{{ $color }}" class="img-thumbnail bear-option rounded-circle border-3" style="width: 130px; height: 130px; object-fit: cover; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                            <div class="mt-2 fw-bold cute-font">{{ ucfirst($color) }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider">
                            <span class="divider-icon">🧸</span>
                        </div>

                        <!-- Accessories -->
                        <div class="mb-5">
                            <label class="form-label fw-bold mb-3 curved-text">Choose Accessories</label>
                            <div class="d-flex gap-4 flex-wrap justify-content-center">
                                @foreach(['bow-tie', 'heart', 'crown'] as $accessory)
                                    <label class="text-center accessory-option-label">
                                        <input type="checkbox" name="accessories[]" value="{{ $accessory }}" class="d-none">
                                        <div class="accessory-container p-3 rounded-4">
                                            <img src="/images/accessories/{{ $accessory }}.png" alt="{{ $accessory }}" class="img-thumbnail accessory-option rounded-circle border-3" style="width: 100px; height: 100px; object-fit: cover; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                                            <div class="mt-2 cute-font">{{ ucfirst(str_replace('-', ' ', $accessory)) }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="divider">
                            <span class="divider-icon">💕</span>
                        </div>

                        <div class="row">
                            <!-- Embroidery Text -->
                            <div class="col-md-6 mb-4">
                                <label for="text" class="form-label fw-bold curved-text">Embroidery Text</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text cute-input-icon"><i class="fas fa-heart"></i></span>
                                    <input type="text" name="text" id="text" class="form-control cute-input" maxlength="20" placeholder="e.g., I Love You">
                                </div>
                                <div class="form-text text-center">Max 20 characters</div>
                            </div>

                            <!-- Voice Recording ID Input -->
                            <div class="col-md-6 mb-4">
                                <label for="voice_recording_id" class="form-label fw-bold curved-text">Voice Recording ID</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text cute-input-icon"><i class="fas fa-music"></i></span>
                                    <input type="number" name="voice_recording_id" id="voice_recording_id" class="form-control cute-input" placeholder="Enter voice recording ID">
                                </div>
                                <div class="form-text text-center">Optional</div>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <div class="mb-4">
                            <label for="special_instructions" class="form-label fw-bold curved-text">Special Instructions</label>
                            <textarea name="special_instructions" id="special_instructions" class="form-control cute-input" maxlength="255" rows="3" placeholder="Any special requests for your bear..."></textarea>
                            <div class="form-text text-center">Optional, max 255 characters</div>
                        </div>

                        <!-- Product ID -->
                        <input type="hidden" name="product_id" value="{{ $product->id ?? 1 }}">

                        <!-- Debug: Show visible checkboxes -->
                        <div class="mb-4 bg-light p-3 rounded-4 d-none">
                            <h5>Debug: Accessory Selection</h5>
                            @foreach(['bow-tie', 'heart', 'crown'] as $accessory)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessories_debug[]" value="{{ $accessory }}" id="debug_{{ $accessory }}">
                                    <label class="form-check-label" for="debug_{{ $accessory }}">
                                        {{ ucfirst(str_replace('-', ' ', $accessory)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-grid gap-3 mt-5">
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg fw-bold cute-button">
                                <i class="fas fa-heart me-2"></i>Save My Beary Special Design
                            </button>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex gap-3">
                                <a href="{{ route('pages.voice_recording') }}" class="btn btn-outline-pink flex-grow-1 cute-outline-button">
                                    <i class="fas fa-microphone me-1"></i>Record Voice
                                </a>
                                <a href="{{ route('voice.messages.index') }}" class="btn btn-outline-pink flex-grow-1 cute-outline-button">
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
    document.querySelectorAll('.bear-option').forEach(img => {
        img.addEventListener('click', function () {
            document.querySelectorAll('input[name="color"]').forEach(radio => radio.checked = false);
            this.closest('.bear-color-option').querySelector('input[type="radio"]').checked = true;

            document.querySelectorAll('.bear-option').forEach(i => {
                i.classList.remove('border-pink');
                i.closest('.color-option-container').classList.remove('selected-option');
            });
            
            this.classList.add('border-pink');
            this.closest('.color-option-container').classList.add('selected-option');
        });
    });

    // Toggle accessory selection
    document.querySelectorAll('.accessory-option').forEach(img => {
        img.addEventListener('click', function () {
            const container = this.closest('.accessory-option-label');
            const checkbox = container.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            
            // Visual feedback
            const accessoryContainer = this.closest('.accessory-container');
            if (checkbox.checked) {
                this.classList.add('border-pink');
                this.classList.add('border-3');
                accessoryContainer.classList.add('selected-accessory');
            } else {
                this.classList.remove('border-pink');
                this.classList.remove('border-3');
                accessoryContainer.classList.remove('selected-accessory');
            }
            
            console.log('Checkbox ' + checkbox.value + ' is now ' + (checkbox.checked ? 'checked' : 'unchecked'));
        });
    });

    // Initialize selected states on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add sparkles to the page
        createSparkles();
        
        // Set initial state for radio buttons
        const selectedColor = document.querySelector('input[name="color"]:checked');
        if (selectedColor) {
            const img = selectedColor.closest('.bear-color-option').querySelector('.bear-option');
            img.classList.add('border-pink');
            img.closest('.color-option-container').classList.add('selected-option');
        }
        
        // Set initial state for checkboxes
        document.querySelectorAll('input[name="accessories[]"]:checked').forEach(checkbox => {
            const img = checkbox.closest('.accessory-option-label').querySelector('.accessory-option');
            img.classList.add('border-pink');
            img.classList.add('border-3');
            img.closest('.accessory-container').classList.add('selected-accessory');
        });
    });
    
    // Create sparkle animation
    function createSparkles() {
        const sparkleContainer = document.createElement('div');
        sparkleContainer.className = 'sparkle-container';
        document.body.appendChild(sparkleContainer);
        
        for (let i = 0; i < 20; i++) {
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
</script>

<style>
    /* Girly color variables */
    :root {
        --pink-light: #FFD1DC;
        --pink-medium: #FF9EBB;
        --pink-dark: #FF85A1;
        --purple-light: #E0BBE4;
        --bg-color: #FFF5F8;
    }
    
    body {
        background-color: #FFF9FB !important;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff9ebb' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* Cute fonts */
    .cute-font {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        font-weight: 600;
        color: #FF85A1;
    }
    
    /* Curved text effect */
    .curved-text {
        font-family: 'Comic Sans MS', cursive, sans-serif;
        color: #FF85A1;
        font-size: 1.3rem;
        position: relative;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
    
    .curved-text:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--pink-medium), transparent);
        border-radius: 50%;
    }
    
    /* Pretty dividers */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 30px 0;
    }
    
    .divider::before, .divider::after {
        content: '';
        flex: 1;
        border-bottom: 2px dashed var(--pink-medium);
    }
    
    .divider-icon {
        padding: 0 15px;
        font-size: 24px;
    }
    
    /* Option styling */
    .color-option-container {
        transition: all 0.4s ease;
        padding: 15px;
        border-radius: 20px;
    }
    
    .selected-option {
        background: linear-gradient(135deg, rgba(255,209,220,0.4) 0%, rgba(255,158,187,0.2) 100%);
        transform: translateY(-8px);
    }
    
    .bear-color-option:hover .color-option-container {
        transform: translateY(-8px) rotate(5deg);
    }
    
    .border-pink {
        border-color: var(--pink-dark) !important;
    }
    
    .accessory-container {
        transition: all 0.4s ease;
        border-radius: 20px;
    }
    
    .selected-accessory {
        background: linear-gradient(135deg, rgba(255,209,220,0.4) 0%, rgba(255,158,187,0.2) 100%);
        transform: scale(1.05);
    }
    
    .accessory-option-label:hover .accessory-container {
        transform: scale(1.05) rotate(3deg);
    }
    
    /* Cute inputs */
    .cute-input {
        border-radius: 15px;
        border: 2px solid var(--pink-light);
        background-color: white;
        transition: all 0.3s ease;
    }
    
    .cute-input:focus {
        border-color: var(--pink-medium);
        box-shadow: 0 0 0 0.25rem rgba(255, 158, 187, 0.25);
    }
    
    .cute-input-icon {
        background-color: var(--pink-light);
        border: 2px solid var(--pink-light);
        color: white;
        border-radius: 15px 0 0 15px;
    }
    
    /* Button styling */
    .cute-button {
        background: linear-gradient(135deg, var(--pink-medium) 0%, var(--pink-dark) 100%);
        border: none;
        color: white;
        border-radius: 30px;
        padding: 12px 25px;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(255, 133, 161, 0.4);
        transition: all 0.3s ease;
    }
    
    .cute-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(255, 133, 161, 0.5);
        background: linear-gradient(135deg, var(--pink-dark) 0%, var(--pink-medium) 100%);
        color: white;
    }
    
    .btn-outline-pink {
        color: var(--pink-dark);
        border-color: var(--pink-medium);
        border-radius: 30px;
        transition: all 0.3s ease;
    }
    
    .cute-outline-button {
        color: var(--pink-dark);
        border: 2px dashed var(--pink-medium);
        border-radius: 30px;
        background-color: rgba(255, 209, 220, 0.1);
        transition: all 0.3s ease;
    }
    
    .cute-outline-button:hover {
        background-color: rgba(255, 209, 220, 0.3);
        color: var(--pink-dark);
        transform: translateY(-2px);
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
        width: 10px;
        height: 10px;
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
            opacity: 1;
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
</style>
@endpush
@endsection