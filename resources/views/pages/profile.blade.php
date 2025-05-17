@extends('layouts.app')

@section('title', 'User Profile | HugsyWugsy')

@section('content')
<div class="profile-container">
    @auth
        <h1 class="profile-title">🐻 HugsyWugsy Profile for {{ Auth::user()->name }} 🐻</h1>

        <div class="profile-card">
            <div class="profile-avatar">
                <img src="{{ asset('images/default_avatar.png') }}" alt="User Avatar">
            </div>

            <div class="profile-info">
                <h2>{{ Auth::user()->name }}</h2>
                <p><strong>📧 Email:</strong> {{ Auth::user()->email }}</p>
                
                @if(Auth::user()->email_verified_at)
                    <p><span class="verified">✔️ Email Verified</span></p>
                @else
                    <p><span class="not-verified">❌ Email Not Verified</span></p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="verify-email-btn">📨 Resend Verification Email</button>
                    </form>
                @endif

                <p><strong>🎀 Member Since:</strong> {{ Auth::user()->created_at->format('F d, Y') }}</p>
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn">✏️ Edit Profile</a>
                
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">🚪 Logout</button>
                </form>
            </div>
        </div>
    @else
        <div class="guest-message">
            <h2>🔒 Please login to view your profile</h2>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="login-btn">🔑 Login</a>
                <a href="{{ route('register') }}" class="register-btn">📝 Register</a>
            </div>
        </div>
    @endauth
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<style>
    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 1.5rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .profile-title {
        text-align: center;
        color: #4a2c82;
        margin-bottom: 2rem;
        font-weight: 700;
    }
    
    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        background-color: #f9f5ff;
        border-radius: 10px;
        border: 2px solid #e2d5f8;
    }
    
    @media (min-width: 768px) {
        .profile-card {
            flex-direction: row;
            align-items: flex-start;
        }
    }
    
    .profile-avatar img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #7e57c2;
        padding: 3px;
        background-color: white;
    }
    
    .profile-info {
        flex: 1;
        padding: 1rem;
    }
    
    .profile-info h2 {
        color: #4a2c82;
        margin-bottom: 1rem;
        font-size: 1.8rem;
    }
    
    .profile-info p {
        margin-bottom: 0.8rem;
        font-size: 1.1rem;
        color: #333;
    }
    
    .verified {
        color: #2e7d32;
        font-weight: 600;
    }
    
    .not-verified {
        color: #c62828;
        font-weight: 600;
    }
    
    .edit-profile-btn, .logout-btn, .verify-email-btn {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.6rem 1.2rem;
        background-color: #7e57c2;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .logout-btn {
        background-color: #e57373;
        margin-left: 0.5rem;
    }
    
    .verify-email-btn {
        background-color: #66bb6a;
    }
    
    .edit-profile-btn:hover, .logout-btn:hover, .verify-email-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .guest-message {
        text-align: center;
        padding: 2rem;
    }
    
    .auth-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .login-btn, .register-btn {
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-btn {
        background-color: #7e57c2;
        color: white;
    }
    
    .register-btn {
        background-color: #4caf50;
        color: white;
    }
    
    .login-btn:hover, .register-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .logout-form {
        display: inline;
    }
</style>
@endpush