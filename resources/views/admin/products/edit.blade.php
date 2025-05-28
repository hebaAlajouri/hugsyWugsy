@extends('layouts.admin')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #FFE8F5 0%, #FFF0F8 50%, #F8E8FF 100%); min-height: 100vh;">
    <!-- Floating Hearts Background -->
    <div class="hearts-bg">
        <div class="heart heart-1">💖</div>
        <div class="heart heart-2">💕</div>
        <div class="heart heart-3">💗</div>
        <div class="heart heart-4">✨</div>
        <div class="heart heart-5">🌸</div>
        <div class="heart heart-6">🦋</div>
    </div>

    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="header-icon mb-3">
            <div class="icon-circle">
                <span style="font-size: 2.5rem;">💖</span>
            </div>
        </div>
        <h2 class="main-title mb-2">Edit Product</h2>
        <p class="subtitle">Make your product even more beautiful ✨</p>
    </div>

    <!-- Main Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="form-card">
                <div class="card-header">
                    <h4 class="card-title">Product Details</h4>
                    <p class="card-subtitle">Update with love and care 💕</p>
                </div>

                <form action="{{ route('admin.products.edit', $product->id) }}" method="POST" class="form-content">
                    @csrf
                    @method('PUT')

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            <span class="label-icon">📝</span>
                            Description
                            <span class="required-star">*</span>
                        </label>
                        <div class="input-wrapper">
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="5" 
                                class="form-control custom-textarea"
                                placeholder="Tell us about your amazing product... ✨">{{ $product->description }}</textarea>
                            <div class="input-border"></div>
                        </div>
                    </div>

                    <!-- Customizable Toggle -->
                    <div class="form-group">
                        <div class="toggle-container">
                            <div class="toggle-content">
                                <div class="toggle-info">
                                    <span class="toggle-icon">🎨</span>
                                    <div class="toggle-text">
                                        <h5 class="toggle-title">Customizable Product</h5>
                                        <p class="toggle-desc">Allow customers to personalize this beautiful item</p>
                                    </div>
                                </div>
                                <div class="toggle-switch">
                                    <input 
                                        type="checkbox" 
                                        name="is_customizable" 
                                        id="is_customizable" 
                                        class="toggle-input"
                                        {{ $product->is_customizable ? 'checked' : '' }}>
                                    <label for="is_customizable" class="toggle-label">
                                        <span class="toggle-slider"></span>
                                        <span class="toggle-text-on">💫</span>
                                        <span class="toggle-text-off">🌙</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn-submit">
                            <span class="btn-icon">🌸</span>
                            <span class="btn-text">Update Product</span>
                            <span class="btn-sparkle">✨</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Background Animation */
.hearts-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -1;
}

.heart {
    position: absolute;
    font-size: 1.5rem;
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.heart-1 { top: 10%; left: 10%; animation-delay: 0s; }
.heart-2 { top: 20%; right: 15%; animation-delay: 1s; }
.heart-3 { top: 60%; left: 20%; animation-delay: 2s; }
.heart-4 { top: 70%; right: 10%; animation-delay: 3s; }
.heart-5 { top: 40%; left: 80%; animation-delay: 4s; }
.heart-6 { top: 80%; left: 60%; animation-delay: 5s; }

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

/* Header Styles */
.header-icon {
    display: flex;
    justify-content: center;
    align-items: center;
}

.icon-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(145deg, #FFB3D9, #FF80CC);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(255, 102, 204, 0.3);
    animation: pulse 2s ease-in-out infinite alternate;
}

@keyframes pulse {
    from { transform: scale(1); }
    to { transform: scale(1.05); }
}

.main-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #D36BA6, #B8589A, #9D4A8E);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
}

.subtitle {
    color: #AD4C8C;
    font-size: 1.1rem;
    font-weight: 500;
    margin: 0;
}

/* Card Styles */
.form-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 25px;
    box-shadow: 0 20px 60px rgba(211, 107, 166, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
}

.form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 80px rgba(211, 107, 166, 0.2);
}

.card-header {
    background: linear-gradient(135deg, #FFE8F5, #FFF0F8);
    padding: 2rem;
    text-align: center;
    border-bottom: 1px solid rgba(245, 169, 192, 0.3);
}

.card-title {
    color: #AD4C8C;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.card-subtitle {
    color: #D36BA6;
    font-size: 0.95rem;
    margin: 0;
}

.form-content {
    padding: 2.5rem;
}

/* Form Group Styles */
.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #AD4C8C;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.75rem;
}

.label-icon {
    font-size: 1.2rem;
}

.required-star {
    color: #FF69B4;
    margin-left: 0.25rem;
}

/* Input Wrapper */
.input-wrapper {
    position: relative;
}

.custom-textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #F5A9C0;
    border-radius: 15px;
    background: linear-gradient(135deg, #FFF8FB, #FFFFFF);
    color: #AD4C8C;
    font-size: 0.95rem;
    resize: vertical;
    min-height: 120px;
    transition: all 0.3s ease;
}

.custom-textarea:focus {
    outline: none;
    border-color: #D36BA6;
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(211, 107, 166, 0.1);
    transform: translateY(-2px);
}

.custom-textarea::placeholder {
    color: #F5A9C0;
    font-style: italic;
}

/* Toggle Container */
.toggle-container {
    background: linear-gradient(135deg, #FFF0F8, #FFE8F5);
    border: 2px solid #F5A9C0;
    border-radius: 20px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.toggle-container:hover {
    border-color: #D36BA6;
    box-shadow: 0 5px 20px rgba(245, 169, 192, 0.2);
}

.toggle-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.toggle-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.toggle-icon {
    font-size: 2rem;
    animation: rotate 3s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.toggle-text {
    flex: 1;
}

.toggle-title {
    color: #AD4C8C;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 0.25rem 0;
}

.toggle-desc {
    color: #D36BA6;
    font-size: 0.9rem;
    margin: 0;
}

/* Custom Toggle Switch */
.toggle-switch {
    position: relative;
}

.toggle-input {
    opacity: 0;
    position: absolute;
}

.toggle-label {
    display: block;
    width: 70px;
    height: 35px;
    background: linear-gradient(135deg, #E0E0E0, #CCCCCC);
    border-radius: 35px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.toggle-slider {
    position: absolute;
    top: 3px;
    left: 3px;
    width: 29px;
    height: 29px;
    background: linear-gradient(135deg, #FFFFFF, #F8F8F8);
    border-radius: 50%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.toggle-input:checked + .toggle-label {
    background: linear-gradient(135deg, #FF80CC, #D36BA6);
}

.toggle-input:checked + .toggle-label .toggle-slider {
    transform: translateX(35px);
    background: linear-gradient(135deg, #FFFFFF, #FFE8F5);
}

.toggle-text-on,
.toggle-text-off {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.toggle-text-on {
    right: 8px;
    opacity: 0;
}

.toggle-text-off {
    left: 8px;
    opacity: 1;
}

.toggle-input:checked + .toggle-label .toggle-text-on {
    opacity: 1;
}

.toggle-input:checked + .toggle-label .toggle-text-off {
    opacity: 0;
}

/* Submit Button */
.btn-submit {
    background: linear-gradient(135deg, #FF80CC, #D36BA6, #B8589A);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(211, 107, 166, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(211, 107, 166, 0.4);
}

.btn-submit:active {
    transform: translateY(-1px);
}

.btn-icon,
.btn-sparkle {
    font-size: 1.2rem;
    animation: bounce 2s infinite;
}

.btn-sparkle {
    animation-delay: 1s;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    60% { transform: translateY(-3px); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .form-content {
        padding: 1.5rem;
    }
    
    .toggle-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .btn-submit {
        padding: 12px 30px;
        font-size: 1rem;
    }
}
</style>
@endsection