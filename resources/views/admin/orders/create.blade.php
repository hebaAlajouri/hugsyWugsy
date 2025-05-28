@extends('layouts.admin')

@section('content')
<div class="feminine-add-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="title-section">
                <h2 class="page-title">
                    <i class="fas fa-plus-circle"></i>
                    Add New Order
                    <span class="subtitle">Create a beautiful new order for your customers</span>
                </h2>
            </div>
            <div class="breadcrumb">
                <a href="{{ route('admin.orders.index') }}" class="breadcrumb-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Orders
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="card-header">
            <h3><i class="fas fa-sparkles"></i> New Order Details</h3>
            <span class="new-badge">New Order</span>
        </div>

        <form action="{{ route('admin.orders.store') }}" method="POST" class="add-form">
            @csrf

            <div class="form-grid">
                <!-- User Selection -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <i class="fas fa-user-plus"></i>
                        Customer
                        <span class="label-subtitle">Select a registered user or create order for guest</span>
                    </label>
                    <div class="select-wrapper">
                        <select name="user_id" class="form-select">
                            <option value="">🎀 Guest Customer</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    👤 {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email Address
                        <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="email" 
                               name="email" 
                               class="form-input" 
                               placeholder="customer@example.com"
                               required>
                        <i class="fas fa-at input-icon"></i>
                    </div>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        Phone Number
                        <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" 
                               name="phone" 
                               class="form-input" 
                               placeholder="+1 (555) 123-4567"
                               required>
                        <i class="fas fa-mobile-alt input-icon"></i>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group full-width">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Delivery Address
                        <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" 
                               name="address" 
                               class="form-input" 
                               placeholder="123 Beautiful Street, Lovely City, State 12345"
                               required>
                        <i class="fas fa-home input-icon"></i>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-credit-card"></i>
                        Payment Method
                        <span class="required">*</span>
                    </label>
                    <div class="select-wrapper">
                        <select name="payment_method" class="form-select" required>
                            <option value="">💳 Select Payment Method</option>
                            <option value="Credit Card">💳 Credit Card</option>
                            <option value="Debit Card">💳 Debit Card</option>
                            <option value="PayPal">💙 PayPal</option>
                            <option value="Apple Pay">🍎 Apple Pay</option>
                            <option value="Google Pay">🟢 Google Pay</option>
                            <option value="Cash on Delivery">💵 Cash on Delivery</option>
                            <option value="Bank Transfer">🏦 Bank Transfer</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <!-- Total -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-dollar-sign"></i>
                        Order Total
                        <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="number" 
                               step="0.01" 
                               name="total" 
                               class="form-input" 
                               placeholder="0.00"
                               min="0"
                               required>
                        <i class="fas fa-coins input-icon"></i>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-heart"></i>
                    Create Order
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Tips Card -->
    <div class="tips-card">
        <div class="tips-header">
            <i class="fas fa-lightbulb"></i>
            <h4>✨ Tips for Creating Orders</h4>
        </div>
        <div class="tips-content">
            <div class="tip">
                <i class="fas fa-star"></i>
                <span>Double-check email addresses to ensure order confirmations reach customers</span>
            </div>
            <div class="tip">
                <i class="fas fa-star"></i>
                <span>Include complete delivery addresses with postal codes</span>
            </div>
            <div class="tip">
                <i class="fas fa-star"></i>
                <span>Verify payment method details before finalizing the order</span>
            </div>
        </div>
    </div>
</div>

<style>
.feminine-add-container {
    padding: 2rem;
    background: linear-gradient(135deg, #fff0f8 0%, #f8f0ff 100%);
    min-height: 100vh;
    font-family: 'Poppins', 'Arial', sans-serif;
}

.page-header {
    margin-bottom: 2rem;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1rem;
}

.title-section {
    flex: 1;
}

.page-title {
    color: #8b5a87;
    font-size: 2.5rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-direction: column;
    align-items: flex-start;
}

.page-title i {
    color: #e91e63;
    font-size: 2rem;
}

.subtitle {
    font-size: 1rem;
    color: #b388b5;
    font-weight: 400;
    margin-top: 0.25rem;
}

.breadcrumb-link {
    background: linear-gradient(135deg, #e1bee7 0%, #ce93d8 100%);
    color: #6a1b9a;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(156, 39, 176, 0.2);
    transition: all 0.3s ease;
}

.breadcrumb-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(156, 39, 176, 0.3);
    color: #4a148c;
    text-decoration: none;
}

.form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(139, 90, 135, 0.1);
    overflow: hidden;
    border: 1px solid rgba(233, 30, 99, 0.1);
    margin-bottom: 2rem;
}

.card-header {
    background: linear-gradient(135deg, #fce4ec 0%, #f3e5f5 100%);
    padding: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid rgba(233, 30, 99, 0.1);
}

.card-header h3 {
    color: #8b5a87;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.new-badge {
    background: linear-gradient(135deg, #4caf50 0%, #66bb6a 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

.add-form {
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    color: #8b5a87;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.25rem;
}

.form-label i {
    color: #e91e63;
    font-size: 1rem;
}

.required {
    color: #f44336;
    font-size: 0.8rem;
    margin-left: 0.25rem;
}

.label-subtitle {
    font-size: 0.8rem;
    color: #b388b5;
    font-weight: 400;
    display: block;
    margin-top: 0.25rem;
}

.input-wrapper, .select-wrapper {
    position: relative;
}

.form-input, .form-select {
    width: 100%;
    padding: 0.875rem 1rem;
    padding-right: 2.5rem;
    border: 2px solid #f8bbd9;
    border-radius: 15px;
    font-size: 0.95rem;
    background: white;
    color: #333;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-input:focus, .form-select:focus {
    outline: none;
    border-color: #e91e63;
    box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
    transform: translateY(-2px);
}

.form-input::placeholder {
    color: #b388b5;
    opacity: 0.8;
}

.input-icon, .select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #e91e63;
    font-size: 0.9rem;
    pointer-events: none;
}

.select-arrow {
    color: #b388b5;
    transition: all 0.3s ease;
}

.form-select:focus + .select-arrow {
    color: #e91e63;
    transform: translateY(-50%) rotate(180deg);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    padding-top: 1rem;
    border-top: 2px solid rgba(233, 30, 99, 0.1);
}

.btn-save {
    background: linear-gradient(135deg, #e91e63 0%, #f06292 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 25px;
    border: none;
    font-weight: 600;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.3);
    transition: all 0.3s ease;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(233, 30, 99, 0.4);
}

.btn-cancel {
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    color: #666;
    padding: 1rem 2rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-cancel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: #555;
    text-decoration: none;
}

.tips-card {
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(255, 152, 0, 0.2);
    box-shadow: 0 4px 20px rgba(255, 152, 0, 0.1);
}

.tips-header {
    background: linear-gradient(135deg, #ffb74d 0%, #ff9800 100%);
    color: white;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.tips-header h4 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.tips-content {
    padding: 1.5rem;
}

.tip {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: #bf360c;
}

.tip:last-child {
    margin-bottom: 0;
}

.tip i {
    color: #ff9800;
    margin-top: 0.1rem;
    font-size: 0.8rem;
}

.tip span {
    font-size: 0.9rem;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .feminine-add-container {
        padding: 1rem;
    }
    
    .header-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .page-title {
        font-size: 2rem;
        text-align: center;
        align-items: center;
    }
    
    .breadcrumb-link {
        align-self: center;
        width: fit-content;
        margin: 0 auto;
    }
    
    .card-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 1.5rem;
    }
    
    .add-form {
        padding: 1.5rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-group.full-width {
        grid-column: 1;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-save, .btn-cancel {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.75rem;
    }
    
    .form-input, .form-select {
        padding: 0.75rem;
        padding-right: 2.25rem;
        font-size: 0.9rem;
    }
    
    .btn-save, .btn-cancel {
        padding: 0.875rem 1.5rem;
        font-size: 0.95rem;
    }
}

/* Animation for form elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    animation: fadeInUp 0.5s ease forwards;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group:nth-child(5) { animation-delay: 0.5s; }
.form-group:nth-child(6) { animation-delay: 0.6s; }

.tips-card {
    animation: fadeInUp 0.8s ease forwards;
    animation-delay: 0.7s;
}
</style>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endsection