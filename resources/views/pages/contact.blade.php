@extends('layouts.app')

@section('title', 'Contact Us - HugsyWugsy')

@section('content')
<div class="contact-us-container">
    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success" style="background-color: #ffe6f0; color: #d4388d; border-color: #ffadd2; border-radius: 20px; box-shadow: 0 4px 10px rgba(232, 62, 140, 0.15);">
            <i class="fas fa-heart me-2 fa-bounce"></i>{{ session('success') }}
        </div>
    @endif

    <div class="text-center mb-5 title-section">
        <div class="flower-decoration left"></div>
        <div class="flower-decoration right"></div>
        <h2 class="contact-us-title" style="color: #ff4291; font-family: 'Poppins', sans-serif; font-weight: 600; letter-spacing: 1.2px; text-shadow: 2px 2px 4px rgba(232, 62, 140, 0.15);">
            <i class="fas fa-envelope-heart me-2 fa-bounce"></i>We'd Love to Hear From You!
        </h2>
        <p class="contact-us-description" style="color: #d355a5; font-family: 'Quicksand', sans-serif; font-size: 1.2rem; font-weight: 500;">
            If you have any questions or feedback, feel free to reach out to us. We're here to help with a smile!
        </p>
      
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
                    <form action="{{ route('messages.store') }}" method="POST" class="contact-form">
                        @csrf
                        
                        <div class="form-group mb-4 float-in">
                            <label for="name" class="form-label" style="color: #ff4291; font-weight: 600; font-family: 'Quicksand', sans-serif; font-size: 1.1rem;">
                                <i class="fas fa-user-heart me-2"></i>Your Name
                            </label>
                            <div class="input-wrapper">
                                <input type="text" id="name" name="name" class="form-input form-control" placeholder="Your lovely name..." required 
                                   style="border-radius: 20px; border: 2px solid #ffc9e0; padding: 14px; background-color: #fffcfd; box-shadow: inset 0 2px 5px rgba(232, 62, 140, 0.1);">
                                <span class="input-focus-effect"></span>
                            </div>
                        </div>
                        
                        <div class="form-group mb-4 float-in">
                            <label for="email" class="form-label" style="color: #ff4291; font-weight: 600; font-family: 'Quicksand', sans-serif; font-size: 1.1rem;">
                                <i class="fas fa-envelope me-2"></i>Your Email
                            </label>
                            <div class="input-wrapper">
                                <input type="email" id="email" name="email" class="form-input form-control" placeholder="Your email address..." required 
                                   style="border-radius: 20px; border: 2px solid #ffc9e0; padding: 14px; background-color: #fffcfd; box-shadow: inset 0 2px 5px rgba(232, 62, 140, 0.1);">
                                <span class="input-focus-effect"></span>
                            </div>
                        
                        
                        <div class="form-group mb-4 float-in">
                            <label for="subject" class="form-label" style="color: #ff4291; font-weight: 600; font-family: 'Quicksand', sans-serif; font-size: 1.1rem;">
                                <i class="fas fa-tag me-2"></i>Subject
                            </label>
                            <div class="input-wrapper">
                                <input type="text" id="subject" name="subject" class="form-input form-control" placeholder="What's this about?" required 
                                   style="border-radius: 20px; border: 2px solid #ffc9e0; padding: 14px; background-color: #fffcfd; box-shadow: inset 0 2px 5px rgba(232, 62, 140, 0.1);">
                                <span class="input-focus-effect"></span>
                            </div>
                        </div>
                        
                        <div class="form-group mb-5 float-in">
                            <label for="message" class="form-label" style="color: #ff4291; font-weight: 600; font-family: 'Quicksand', sans-serif; font-size: 1.1rem;">
                                <i class="fas fa-comment-dots me-2"></i>Your Message
                            </label>
                            <div class="input-wrapper">
                                <textarea id="message" name="message" class="form-input form-control" rows="5" placeholder="Tell us what's on your mind..." required 
                                      style="border-radius: 20px; border: 2px solid #ffc9e0; padding: 14px; background-color: #fffcfd; box-shadow: inset 0 2px 5px rgba(232, 62, 140, 0.1);"></textarea>
                                <span class="input-focus-effect"></span>
                            </div>
                        </div>
                        
                        <div class="text-center mt-5">
                            <button type="submit" class="submit-button btn" 
                                    style="background: linear-gradient(to right, #ff6bac, #ff4291); color: white; border: none; padding: 14px 35px; 
                                    border-radius: 30px; font-weight: 600; letter-spacing: 1.2px; font-family: 'Poppins', sans-serif; font-size: 1.1rem;
                                    box-shadow: 0 8px 20px rgba(232, 62, 140, 0.3); transition: all 0.3s ease;">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            
        </div>
    </div>
    
    <div class="decorative-elements">
        <div class="floating-heart" style="top: 10%; left: 5%;">
            <i class="fas fa-heart"></i>
        </div>
        <div class="floating-heart" style="top: 25%; right: 8%;">
            <i class="fas fa-heart"></i>
        </div>
        <div class="floating-heart" style="bottom: 15%; left: 10%;">
            <i class="fas fa-heart"></i>
        </div>
        <div class="floating-heart" style="bottom: 30%; right: 5%;">
            <i class="fas fa-heart"></i>
        </div>
        <div class="floating-sparkle" style="top: 20%; left: 15%;">
            <i class="fas fa-sparkles"></i>
        </div>
        <div class="floating-sparkle" style="bottom: 25%; right: 15%;">
            <i class="fas fa-sparkles"></i>
        </div>
        <div class="ribbon top-left"></div>
        <div class="ribbon bottom-right"></div>
    </div>
</div>

<style>
    /* Importing feminine fonts with additional weights */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap');
    
    /* Override Bootstrap styles with enhanced feminine design */
    .contact-us-container {
        position: relative;
        padding: 2rem 1.5rem;
        max-width: 1000px;
        margin: 0 auto;
      
      
        overflow: hidden;
    }
    
    /* Enhanced form styling */
    .form-input {
        transition: all 0.4s ease;
        font-family: 'Quicksand', sans-serif;
        font-size: 1.05rem;
    }
    
    .form-input:focus {
        border-color: #ff4291 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 66, 145, 0.25) !important;
        transform: translateY(-2px);
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .input-focus-effect {
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(to right, #ff6bac, #ff4291);
        transition: all 0.4s ease;
        transform: translateX(-50%);
    }
    
    .form-input:focus + .input-focus-effect {
        width: calc(100% - 40px);
    }
    
    /* Enhanced button styles */
    .submit-button {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }
    
    .submit-button:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 12px 25px rgba(232, 62, 140, 0.4) !important;
        background: linear-gradient(to right, #ff5aa2, #ff338a) !important;
    }
    
    .submit-button:active {
        transform: translateY(-2px) scale(0.98);
    }
    
    /* Form group hover effect */
    .form-group {
        transition: all 0.4s ease;
        position: relative;
    }
    
    .form-group:hover {
        transform: translateY(-3px);
    }
    
    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 10px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #fff0f7;
        border-radius: 10px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #ffc9e0, #ff9ec8);
        border-radius: 10px;
        border: 3px solid #fff0f7;
    }
    
    /* Decorative elements */
    .decorative-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }
    
    .floating-heart {
        position: absolute;
        color: rgba(255, 105, 180, 0.1);
        font-size: 2.5rem;
        animation: float 6s infinite ease-in-out;
    }
    
    .floating-sparkle {
        position: absolute;
        color: rgba(255, 223, 238, 0.6);
        font-size: 1.5rem;
        animation: sparkle 4s infinite ease-in-out;
    }
    
    .ribbon {
        position: absolute;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(255, 182, 214, 0.4) 0%, rgba(255, 223, 238, 0.2) 100%);
        border-radius: 50%;
    }
    
    .ribbon.top-left {
        top: -100px;
        left: -100px;
    }
    
    .ribbon.bottom-right {
        bottom: -100px;
        right: -100px;
    }
    
    /* Title section enhancements */
    .title-section {
        position: relative;
    }
    
    .flower-decoration {
        position: absolute;
        width: 80px;
        height: 80px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23ffb6d6' d='M50 0 C60 30 70 40 100 50 C70 60 60 70 50 100 C40 70 30 60 0 50 C30 40 40 30 50 0'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        opacity: 0.2;
        z-index: -1;
    }
    
    .flower-decoration.left {
        top: -20px;
        left: 5%;
        transform: rotate(-20deg);
    }
    
    .flower-decoration.right {
        top: -10px;
        right: 5%;
        transform: rotate(20deg);
    }
    
    .heart-divider {
        margin: 15px auto;
        text-align: center;
        color: #ffc9e0;
    }
    
    .heart-divider i {
        margin: 0 8px;
        font-size: 0.8rem;
    }
    
    .heart-divider i:nth-child(1) {
        animation: pulse 2s infinite 0.2s;
    }
    
    .heart-divider i:nth-child(2) {
        font-size: 1rem;
        animation: pulse 2s infinite;
    }
    
    .heart-divider i:nth-child(3) {
        animation: pulse 2s infinite 0.4s;
    }
    
    /* Enhanced animations */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }
    
    @keyframes sparkle {
        0%, 100% { opacity: 0.3; transform: scale(0.8); }
        50% { opacity: 0.8; transform: scale(1.2); }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.7; }
        50% { transform: scale(1.2); opacity: 1; }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    /* Float-in animation for form elements */
    .float-in {
        animation: floatIn 0.8s forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .float-in:nth-child(1) { animation-delay: 0.1s; }
    .float-in:nth-child(2) { animation-delay: 0.2s; }
    .float-in:nth-child(3) { animation-delay: 0.3s; }
    .float-in:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes floatIn {
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Background styling */
    body {
        background-color: #fff0f7;
        background-image: linear-gradient(45deg, #ffe6f0 25%, transparent 25%, transparent 75%, #ffe6f0 75%, #ffe6f0), 
                          linear-gradient(45deg, #ffe6f0 25%, transparent 25%, transparent 75%, #ffe6f0 75%, #ffe6f0);
        background-size: 40px 40px;
        background-position: 0 0, 20px 20px;
    }
    
    /* Enhanced alert styling */
    .alert {
        border-radius: 20px;
        padding: 16px 24px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 500;
        letter-spacing: 0.5px;
        animation: fadeInDown 0.5s forwards;
    }
    
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contact-us-container {
            padding: 3rem 1rem;
            border-radius: 30px;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .form-input {
            font-size: 1rem;
            padding: 12px !important;
        }
        
        .contact-us-title {
            font-size: 1.8rem;
        }
        
        .contact-us-description {
            font-size: 1rem !important;
        }
        
        .floating-heart, .floating-sparkle {
            display: none;
        }
    }

    /* Font Awesome animation additions */
    .fa-bounce {
        animation: bounce 2s infinite;
    }
</style>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact-usStyle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add subtle hover effects to form elements
    document.addEventListener('DOMContentLoaded', function() {
        const formGroups = document.querySelectorAll('.form-group');
        
        formGroups.forEach(group => {
            const label = group.querySelector('.form-label');
            const input = group.querySelector('.form-input');
            
            input.addEventListener('focus', function() {
                label.style.color = '#ff338a';
                label.style.transform = 'scale(1.05)';
                label.style.transition = 'all 0.3s ease';
            });
            
            input.addEventListener('blur', function() {
                label.style.color = '#ff4291';
                label.style.transform = 'scale(1)';
            });
        });
        
        // Add success message animation
        const successMessage = document.querySelector('.alert-success');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = 'all 0.5s ease';
                successMessage.style.transform = 'translateY(-10px)';
            }, 200);
        }
    });
</script>
@endpush