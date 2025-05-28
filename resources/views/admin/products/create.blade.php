@extends('layouts.admin')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #FFE8F5 0%, #FFF0F8 50%, #F8E8FF 100%); min-height: 100vh;">
    <!-- Floating Elements Background -->
    <div class="floating-elements">
        <div class="floating-item item-1">💖</div>
        <div class="floating-item item-2">🌸</div>
        <div class="floating-item item-3">✨</div>
        <div class="floating-item item-4">🦋</div>
        <div class="floating-item item-5">💕</div>
        <div class="floating-item item-6">🌺</div>
        <div class="floating-item item-7">💫</div>
    </div>

    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="header-decoration mb-4">
            <div class="main-icon">
                <span style="font-size: 3rem;">✨</span>
            </div>
        </div>
        <h2 class="page-title mb-2">Add New Product</h2>
        <p class="page-subtitle">Create something beautiful for your customers 💖</p>
    </div>

    <!-- Main Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="product-form-card">
                <div class="form-header">
                    <h3 class="form-title">Product Information</h3>
                    <p class="form-subtitle">Fill in the details with love ✨</p>
                </div>

                <form action="{{ route('admin.products.store') }}" method="POST" class="product-form">
                    @csrf
                    
                    <!-- Product Name -->
                    <div class="form-group">
                        <label class="field-label">
                            <span class="label-icon">💎</span>
                            Product Name
                            <span class="required">*</span>
                        </label>
                        <div class="input-container">
                            <input type="text" 
                                   name="name" 
                                   class="styled-input" 
                                   placeholder="Enter your beautiful product name..."
                                   required>
                            <div class="input-underline"></div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label class="field-label">
                            <span class="label-icon">📝</span>
                            Description
                        </label>
                        <div class="input-container">
                            <textarea name="description" 
                                      class="styled-textarea" 
                                      rows="4"
                                      placeholder="Describe your amazing product..."></textarea>
                            <div class="input-underline"></div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label class="field-label">
                            <span class="label-icon">💰</span>
                            Price
                            <span class="required">*</span>
                        </label>
                        <div class="input-container price-input">
                            <span class="currency-symbol">$</span>
                            <input type="number" 
                                   step="0.01" 
                                   name="price" 
                                   class="styled-input price-field" 
                                   placeholder="0.00"
                                   required>
                            <div class="input-underline"></div>
                        </div>
                    </div>

                    <!-- Image Path -->
                    <div class="form-group">
                        <label class="field-label">
                            <span class="label-icon">🖼️</span>
                            Image Path
                            <span class="optional">(optional)</span>
                        </label>
                        <div class="input-container">
                            <input type="text" 
                                   name="image" 
                                   class="styled-input" 
                                   placeholder="Enter image path or URL...">
                            <div class="input-underline"></div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label class="field-label">
                            <span class="label-icon">🏷️</span>
                            Category
                            <span class="required">*</span>
                        </label>
                        <div class="input-container">
                            <input type="text" 
                                   name="category" 
                                   class="styled-input" 
                                   placeholder="Enter product category..."
                                   required>
                            <div class="input-underline"></div>
                        </div>
                    </div>

                    <!-- Customizable Toggle -->
                    <div class="form-group">
                        <div class="toggle-section">
                            <div class="toggle-info">
                                <span class="toggle-emoji">🎨</span>
                                <div class="toggle-content">
                                    <h5 class="toggle-title">Customizable Product</h5>
                                    <p class="toggle-description">Allow customers to personalize this item</p>
                                </div>
                            </div>
                            <div class="custom-toggle">
                                <input type="checkbox" 
                                       name="is_customizable" 
                                       value="1" 
                                       id="customizable-toggle" 
                                       class="toggle-checkbox">
                                <label for="customizable-toggle" class="toggle-switch">
                                    <span class="toggle-slider">
                                        <span class="toggle-icon-off">🌙</span>
                                        <span class="toggle-icon-on">✨</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn-hugsy">
                            <span class="btn-icon">🌸</span>
                            <span class="btn-text">Save Product</span>
                            <span class="btn-sparkle">💫</span>
                            <div class="btn-ripple"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Floating Background Elements */
.floating-elements {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -1;
}

.floating-item {
    position: absolute;
    font-size: 1.5rem;
    opacity: 0.08;
    animation: gentleFloat 8s ease-in-out infinite;
}

.item-1 { top: 15%; left: 10%; animation-delay: 0s; }
.item-2 { top: 25%; right: 15%; animation-delay: 1.5s; }
.item-3 { top: 45%; left: 5%; animation-delay: 3s; }
.item-4 { top: 65%; right: 20%; animation-delay: 4.5s; }
.item-5 { top: 35%; right: 5%; animation-delay: 6s; }
.item-6 { top: 75%; left: 15%; animation-delay: 7.5s; }
.item-7 { top: 55%; left: 85%; animation-delay: 2s; }

@keyframes gentleFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.08; }
    25% { transform: translateY(-15px) rotate(2deg); opacity: 0.12; }
    50% { transform: translateY(-25px) rotate(-1deg); opacity: 0.15; }
    75% { transform: translateY(-10px) rotate(1deg); opacity: 0.10; }
}

/* Header Styles */
.header-decoration {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

.main-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(145deg, #FFB3D9, #FF80CC);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 10px 30px rgba(255, 102, 204, 0.3),
        inset 0 2px 10px rgba(255, 255, 255, 0.5);
    animation: headerPulse 3s ease-in-out infinite;
    position: relative;
}

.main-icon::before {
    content: '';
    position: absolute;
    width: 110px;
    height: 110px;
    border: 2px solid rgba(255, 128, 204, 0.3);
    border-radius: 50%;
    animation: ripple 2s ease-out infinite;
}

@keyframes headerPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes ripple {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(1.2); opacity: 0; }
}

.page-title {
    font-size: 2.8rem;
    font-weight: 700;
    background: linear-gradient(135deg, #D36BA6, #B8589A, #9D4A8E);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
    text-shadow: 0 2px 10px rgba(211, 107, 166, 0.3);
}

.page-subtitle {
    color: #AD4C8C;
    font-size: 1.2rem;
    font-weight: 500;
    margin: 0;
}

/* Form Card */
.product-form-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 30px;
    box-shadow: 
        0 25px 70px rgba(211, 107, 166, 0.15),
        0 10px 30px rgba(255, 128, 204, 0.1);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.4);
    overflow: hidden;
    transition: all 0.4s ease;
}

.product-form-card:hover {
    transform: translateY(-8px);
    box-shadow: 
        0 35px 90px rgba(211, 107, 166, 0.2),
        0 15px 40px rgba(255, 128, 204, 0.15);
}

.form-header {
    background: linear-gradient(135deg, #FFE8F5, #FFF0F8, #F8E8FF);
    padding: 2.5rem;
    text-align: center;
    border-bottom: 1px solid rgba(245, 169, 192, 0.2);
    position: relative;
}

.form-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #FF80CC, #D36BA6);
    border-radius: 2px;
}

.form-title {
    color: #AD4C8C;
    font-size: 1.6rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.form-subtitle {
    color: #D36BA6;
    font-size: 1rem;
    margin: 0;
    font-style: italic;
}

/* Form Styles */
.product-form {
    padding: 3rem;
}

.form-group {
    margin-bottom: 2.5rem;
}

.field-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #AD4C8C;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.label-icon {
    font-size: 1.3rem;
    animation: iconBounce 3s ease-in-out infinite;
}

@keyframes iconBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.required {
    color: #FF69B4;
    font-weight: bold;
}

.optional {
    color: #F5A9C0;
    font-size: 0.9rem;
    font-style: italic;
}

/* Input Styles */
.input-container {
    position: relative;
}

.styled-input,
.styled-textarea {
    width: 100%;
    padding: 1.2rem 1.5rem;
    border: 2px solid transparent;
    border-radius: 20px;
    background: linear-gradient(135deg, #FFF8FB, #FFFFFF);
    color: #AD4C8C;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(245, 169, 192, 0.1);
}

.styled-input:focus,
.styled-textarea:focus {
    outline: none;
    border-color: #D36BA6;
    background: #FFFFFF;
    box-shadow: 
        0 0 0 4px rgba(211, 107, 166, 0.1),
        0 8px 25px rgba(245, 169, 192, 0.2);
    transform: translateY(-2px);
}

.styled-input::placeholder,
.styled-textarea::placeholder {
    color: #F5A9C0;
    font-style: italic;
}

.styled-textarea {
    resize: vertical;
    min-height: 120px;
}

/* Price Input */
.price-input {
    position: relative;
}

.currency-symbol {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: #AD4C8C;
    font-weight: bold;
    font-size: 1.1rem;
    z-index: 2;
}

.price-field {
    padding-left: 3rem;
}

/* Toggle Section */
.toggle-section {
    background: linear-gradient(135deg, #FFF0F8, #FFE8F5);
    border: 2px solid #F5A9C0;
    border-radius: 25px;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
}

.toggle-section:hover {
    border-color: #D36BA6;
    box-shadow: 0 8px 25px rgba(245, 169, 192, 0.2);
}

.toggle-info {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.toggle-emoji {
    font-size: 2.5rem;
    animation: spin 4s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.toggle-content h5 {
    color: #AD4C8C;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.toggle-content p {
    color: #D36BA6;
    font-size: 0.95rem;
    margin: 0;
}

/* Custom Toggle Switch */
.custom-toggle {
    position: relative;
}

.toggle-checkbox {
    opacity: 0;
    position: absolute;
}

.toggle-switch {
    display: block;
    width: 80px;
    height: 40px;
    background: linear-gradient(135deg, #E0E0E0, #CCCCCC);
    border-radius: 40px;
    position: relative;
    cursor: pointer;
    transition: all 0.4s ease;
    box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
}

.toggle-slider {
    position: absolute;
    top: 4px;
    left: 4px;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #FFFFFF, #F8F8F8);
    border-radius: 50%;
    transition: all 0.4s ease;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.toggle-icon-on,
.toggle-icon-off {
    position: absolute;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.toggle-icon-off {
    opacity: 1;
}

.toggle-icon-on {
    opacity: 0;
}

.toggle-checkbox:checked + .toggle-switch {
    background: linear-gradient(135deg, #FF80CC, #D36BA6);
}

.toggle-checkbox:checked + .toggle-switch .toggle-slider {
    transform: translateX(40px);
    background: linear-gradient(135deg, #FFFFFF, #FFE8F5);
}

.toggle-checkbox:checked + .toggle-switch .toggle-icon-off {
    opacity: 0;
}

.toggle-checkbox:checked + .toggle-switch .toggle-icon-on {
    opacity: 1;
}

/* Submit Button */
.btn-hugsy {
    background: linear-gradient(135deg, #FF80CC, #D36BA6, #B8589A);
    color: white;
    border: none;
    padding: 18px 50px;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.4s ease;
    box-shadow: 
        0 10px 30px rgba(211, 107, 166, 0.3),
        0 4px 15px rgba(255, 128, 204, 0.2);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-hugsy::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.btn-hugsy:hover::before {
    left: 100%;
}

.btn-hugsy:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 
        0 20px 45px rgba(211, 107, 166, 0.4),
        0 8px 25px rgba(255, 128, 204, 0.3);
}

.btn-hugsy:active {
    transform: translateY(-2px) scale(1.01);
}

.btn-icon,
.btn-sparkle {
    font-size: 1.3rem;
    animation: buttonFloat 2.5s ease-in-out infinite;
}

.btn-sparkle {
    animation-delay: 1.25s;
}

@keyframes buttonFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-4px); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 2.2rem;
    }
    
    .product-form {
        padding: 2rem;
    }
    
    .toggle-section {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
    }
    
    .toggle-info {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-hugsy {
        padding: 15px 35px;
        font-size: 1rem;
    }
    
    .form-group {
        margin-bottom: 2rem;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.8rem;
    }
    
    .product-form {
        padding: 1.5rem;
    }
    
    .form-header {
        padding: 2rem;
    }
}
</style>
@endsection