@extends('layouts.admin')

@section('content')
{{-- 🌸 Custom Styles --}}
<style>
    .create-container {
        background: linear-gradient(135deg, #ffeef8 0%, #f8f4ff 100%);
        min-height: 100vh;
        padding: 2rem;
    }
    
    .form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 25px;
        padding: 3rem;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 15px 40px rgba(255, 182, 193, 0.25);
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #ff9a9e 0%, #fecfef 50%, #a29bfe 100%);
    }
    
    .page-title {
        color: #6b4c7a;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        text-shadow: 2px 2px 4px rgba(255, 182, 193, 0.3);
    }
    
    .form-group {
        margin-bottom: 1.8rem;
        position: relative;
    }
    
    .form-label {
        color: #8b5a96;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #f0e6f7;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        color: #5a4a6b;
        font-weight: 500;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #c44569;
        background: white;
        box-shadow: 0 5px 20px rgba(196, 69, 105, 0.15);
        transform: translateY(-2px);
    }
    
    .form-control-custom::placeholder {
        color: #b298c7;
        font-style: italic;
    }
    
    .select-wrapper {
        position: relative;
    }
    
    .select-wrapper::after {
        content: '💖';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 1.2rem;
    }
    
    .form-select-custom {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: rgba(255, 255, 255, 0.8);
        padding-right: 50px;
    }
    
    .password-wrapper {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #b298c7;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .password-toggle:hover {
        color: #c44569;
        background: rgba(196, 69, 105, 0.1);
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
        border: none;
        border-radius: 25px;
        padding: 15px 40px;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1rem;
        cursor: pointer;
    }
    
    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(196, 69, 105, 0.4);
        color: white;
    }
    
    .submit-btn:active {
        transform: translateY(-1px);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #8b5a96;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        padding: 10px 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.7);
        border: 2px solid rgba(255, 182, 193, 0.2);
        transition: all 0.3s ease;
    }
    
    .back-link:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #6b4c7a;
        text-decoration: none;
        transform: translateX(-5px);
        border-color: rgba(255, 182, 193, 0.4);
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #b298c7;
        pointer-events: none;
        z-index: 1;
    }
    
    .has-icon .form-control-custom {
        padding-left: 50px;
    }
    
    .has-password-toggle .form-control-custom {
        padding-right: 50px;
    }
    
    .form-floating {
        position: relative;
    }
    
    .floating-label {
        position: absolute;
        top: 15px;
        left: 20px;
        color: #b298c7;
        font-size: 1rem;
        transition: all 0.3s ease;
        pointer-events: none;
        background: white;
        padding: 0 5px;
        border-radius: 5px;
    }
    
    .form-control-custom:focus + .floating-label,
    .form-control-custom:not(:placeholder-shown) + .floating-label {
        top: -8px;
        font-size: 0.85rem;
        color: #c44569;
        font-weight: 600;
    }
    
    .form-hint {
        font-size: 0.85rem;
        color: #b298c7;
        margin-top: 0.5rem;
        font-style: italic;
    }
    
    @media (max-width: 768px) {
        .create-container {
            padding: 1rem;
        }
        
        .form-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .form-control-custom {
            padding: 12px 15px;
        }
        
        .has-icon .form-control-custom {
            padding-left: 40px;
        }
        
        .input-icon {
            left: 12px;
            font-size: 1rem;
        }
    }
    
    .sparkle-decoration {
        position: absolute;
        color: rgba(255, 182, 193, 0.4);
        font-size: 1.5rem;
        animation: sparkle 2s ease-in-out infinite;
    }
    
    .sparkle-1 { top: 10%; right: 10%; animation-delay: 0s; }
    .sparkle-2 { top: 70%; left: 10%; animation-delay: 0.7s; }
    .sparkle-3 { top: 40%; right: 5%; animation-delay: 1.4s; }
    
    @keyframes sparkle {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.2); }
    }
</style>

<div class="create-container">
    {{-- ✨ Decorative Sparkles --}}
    <div class="sparkle-decoration sparkle-1">✨</div>
    <div class="sparkle-decoration sparkle-2">💫</div>
    <div class="sparkle-decoration sparkle-3">🌟</div>
    
    {{-- 🔙 Back Link --}}
    <a href="{{ route('admin.users.index') }}" class="back-link">
        <span>💕</span>
        Back to Users List
    </a>
    
    <div class="form-card">
        <h2 class="page-title">
            <span>✨</span>
            Create New User
            <span>💖</span>
        </h2>
        
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="form-group has-icon">
                <label for="name" class="form-label">
                    <span>👤</span>
                    Full Name
                </label>
                <div class="form-floating">
                    <input type="text" 
                           name="name" 
                           id="name"
                           class="form-control-custom" 
                           placeholder="Enter full name"
                           required>
                    <div class="input-icon">👤</div>
                </div>
                <div class="form-hint">✨ Enter the user's complete name</div>
            </div>
            
            <div class="form-group has-icon">
                <label for="email" class="form-label">
                    <span>📧</span>
                    Email Address
                </label>
                <div class="form-floating">
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="form-control-custom" 
                           placeholder="Enter email address"
                           required>
                    <div class="input-icon">📧</div>
                </div>
                <div class="form-hint">💌 This will be used for login and notifications</div>
            </div>
            
            <div class="form-group">
                <label for="role" class="form-label">
                    <span>🎀</span>
                    User Role
                </label>
                <div class="select-wrapper">
                    <select name="role" 
                            id="role"
                            class="form-control-custom form-select-custom">
                        <option value="user">👩‍💼 User</option>
                        <option value="admin">👑 Admin</option>
                    </select>
                </div>
                <div class="form-hint">🌟 Choose the appropriate access level</div>
            </div>
            
            <div class="form-group has-icon has-password-toggle">
                <label for="password" class="form-label">
                    <span>🔐</span>
                    Password
                </label>
                <div class="form-floating password-wrapper">
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control-custom" 
                           placeholder="Enter secure password"
                           required>
                    <div class="input-icon">🔐</div>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        👁️
                    </button>
                </div>
                <div class="form-hint">🔒 Create a strong password with at least 8 characters</div>
            </div>
            
            <button type="submit" class="submit-btn">
                <span>✨</span>
                Create User
                <span>🎉</span>
            </button>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordField = document.getElementById('password');
    const toggleButton = document.querySelector('.password-toggle');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.textContent = '🙈';
    } else {
        passwordField.type = 'password';
        toggleButton.textContent = '👁️';
    }
}
</script>

@endsection