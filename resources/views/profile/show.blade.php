@extends('layouts.app')

@section('title', 'User Profile | HugsyWugsy')

@section('content')
<div class="profile-container">
    @auth
        <div class="ribbon-top"></div>
        <div class="hearts-container">
            <div class="heart heart1">❤️</div>
            <div class="heart heart2">💕</div>
            <div class="heart heart3">💖</div>
            <div class="heart heart4">💗</div>
        </div>
        
        <h1 class="profile-title">✨ HugsyWugsy Profile for {{ Auth::user()->name }} ✨</h1>
        <div class="sparkles-container">
            <div class="sparkle sparkle1">✨</div>
            <div class="sparkle sparkle2">✨</div>
            <div class="sparkle sparkle3">✨</div>
        </div>
        
        <div class="profile-card">
            <div class="profile-avatar">
                <div class="avatar-frame">
                    <img src="{{ asset('images/default_avatar.png') }}" alt="User Avatar">
                </div>
                <div class="avatar-decoration"></div>
            </div>

            <div class="profile-info">
                <h2>{{ Auth::user()->name }} <span class="profile-emoji">🦄</span></h2>
                <div class="info-item">
                    <span class="info-icon">💌</span>
                    <span class="info-text">{{ Auth::user()->email }}</span>
                </div>
                
                <div class="info-item role-badge">
                    <span class="info-icon">👑</span>
                    <span class="info-text">Role: 
                        <span class="role-name">
                            @if(Auth::user()->role)
                                {{ Auth::user()->role }}
                            @else
                                Member
                            @endif
                        </span>
                    </span>
                    <div class="role-sparkle"></div>
                </div>

                <div class="info-item">
                    <span class="info-icon">🎀</span>
                    <span class="info-text">Member Since: {{ Auth::user()->created_at->format('F d, Y') }}</span>
                </div>
                
                <div class="buttons-container">
                    <a href="{{ route('profile.edit') }}" class="edit-profile-btn">✏️ Edit Profile</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="profile-footer">
            <div class="decoration decoration-left"></div>
            <div class="decoration decoration-right"></div>
        </div>
    @else
        <div class="guest-message">
            <div class="hearts-container">
                <div class="heart heart1">❤️</div>
                <div class="heart heart2">💕</div>
            </div>
            
            <h2>🔒 Please login to view your profile</h2>
            
            <div class="guest-image">
                <img src="{{ asset('images/default_avatar.png') }}" alt="Guest" class="guest-avatar">
                <div class="avatar-glow"></div>
            </div>
            
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #fff9fc;
        font-family: 'Poppins', sans-serif;
    }
    
    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(252, 186, 211, 0.4);
        position: relative;
        overflow: hidden;
    }
    
    .ribbon-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(to right, #fc8bab, #f786aa, #ffadd2, #f786aa, #fc8bab);
    }
    
    .hearts-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .heart {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.7;
        animation: float 10s infinite ease-in-out;
    }
    
    .heart1 {
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .heart2 {
        top: 15%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .heart3 {
        bottom: 15%;
        left: 15%;
        animation-delay: 4s;
    }
    
    .heart4 {
        bottom: 10%;
        right: 15%;
        animation-delay: 6s;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) scale(1);
        }
        50% {
            transform: translateY(-15px) scale(1.1);
        }
    }
    
    .sparkles-container {
        position: relative;
        height: 0;
    }
    
    .sparkle {
        position: absolute;
        font-size: 1.2rem;
        animation: twinkle 3s infinite ease-in-out;
    }
    
    .sparkle1 {
        top: -60px;
        left: 25%;
        animation-delay: 0s;
    }
    
    .sparkle2 {
        top: -40px;
        left: 50%;
        animation-delay: 1s;
    }
    
    .sparkle3 {
        top: -60px;
        left: 75%;
        animation-delay: 2s;
    }
    
    @keyframes twinkle {
        0%, 100% {
            opacity: 0.5;
            transform: scale(0.8);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }
    
    .profile-title {
        text-align: center;
        color: #e83e8c;
        margin-bottom: 2.5rem;
        font-weight: 700;
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        text-shadow: 1px 1px 2px rgba(232, 62, 140, 0.2);
        position: relative;
        z-index: 2;
    }
    
    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2rem;
        padding: 2rem;
        background-color: #fef5f9;
        border-radius: 20px;
        border: 2px dashed #ffadd2;
        position: relative;
        z-index: 2;
    }
    
    @media (min-width: 768px) {
        .profile-card {
            flex-direction: row;
            align-items: flex-start;
        }
    }
    
    .profile-avatar {
        position: relative;
    }
    
    .avatar-frame {
        position: relative;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: linear-gradient(to bottom right, #ffadd2, #ff85a1);
        padding: 5px;
        box-shadow: 0 5px 15px rgba(232, 62, 140, 0.3);
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
    }
    
    .avatar-decoration {
        position: absolute;
        width: 190px;
        height: 190px;
        top: -10px;
        left: -10px;
        border-radius: 50%;
        border: 2px dotted #ffadd2;
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    .profile-info {
        flex: 1;
        padding: 1.5rem;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    .profile-info h2 {
        color: #e83e8c;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .profile-emoji {
        margin-left: 0.5rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.8rem;
        background-color: #fef5f9;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .info-item:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .info-icon {
        margin-right: 1rem;
        font-size: 1.2rem;
    }
    
    .info-text {
        color: #666;
        font-size: 1rem;
    }
    
    .role-badge {
        background-color: #fff0f5;
        border: 1px dashed #ffb6c1;
        position: relative;
    }
    
    .role-name {
        font-weight: 600;
        color: #e83e8c;
        position: relative;
    }
    
    .role-sparkle {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        animation: sparkleGlow 2s infinite;
    }
    
    @keyframes sparkleGlow {
        0%, 100% {
            box-shadow: 0 0 5px 2px rgba(232, 62, 140, 0.3);
        }
        50% {
            box-shadow: 0 0 10px 5px rgba(232, 62, 140, 0.6);
        }
    }
    
    .buttons-container {
        display: flex;
        margin-top: 1.5rem;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    
    .edit-profile-btn, .logout-btn {
        display: inline-block;
        padding: 0.7rem 1.3rem;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .edit-profile-btn {
        background: linear-gradient(to right, #ff85a1, #ff5d8f);
    }
    
    .logout-btn {
        background: linear-gradient(to right, #ffadd2, #ff85a1);
    }
    
    .edit-profile-btn:hover, .logout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .profile-footer {
        position: relative;
        height: 40px;
        margin-top: 2rem;
    }
    
    .decoration {
        position: absolute;
        width: 100px;
        height: 20px;
        bottom: 0;
    }
    
    .decoration-left {
        left: 0;
        background: radial-gradient(circle at left, #ffadd2 10%, transparent 11%), 
                    radial-gradient(circle at left, #ffadd2 10%, transparent 11%);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
    
    .decoration-right {
        right: 0;
        background: radial-gradient(circle at right, #ffadd2 10%, transparent 11%), 
                    radial-gradient(circle at right, #ffadd2 10%, transparent 11%);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
    
    /* Guest styles */
    .guest-message {
        text-align: center;
        background-color: #fef5f9;
        padding: 3rem 2rem;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(252, 186, 211, 0.3);
        position: relative;
    }
    
    .guest-message h2 {
        color: #e83e8c;
        margin-bottom: 2rem;
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
    }
    
    .guest-image {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
    }
    
    .guest-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffadd2;
        padding: 3px;
        background-color: white;
    }
    
    .avatar-glow {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,173,210,0.3), rgba(255,133,161,0.3));
        animation: glowPulse 3s infinite alternate;
    }
    
    @keyframes glowPulse {
        0% {
            transform: scale(1);
            opacity: 0.5;
        }
        100% {
            transform: scale(1.1);
            opacity: 0.2;
        }
    }
    
    .auth-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .login-btn, .register-btn {
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .login-btn {
        background: linear-gradient(to right, #ff85a1, #ff5d8f);
        color: white;
    }
    
    .register-btn {
        background: linear-gradient(to right, #ffadd2, #ff85a1);
        color: white;
    }
    
    .login-btn:hover, .register-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }
    
    .logout-form {
        display: inline;
    }
</style>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #fff9fc;
        font-family: 'Poppins', sans-serif;
    }
    
    .profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(252, 186, 211, 0.4);
        position: relative;
        overflow: hidden;
    }
    
    .ribbon-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        background: linear-gradient(to right, #fc8bab, #f786aa, #ffadd2, #f786aa, #fc8bab);
    }
    
    .hearts-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .heart {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.7;
        animation: float 10s infinite ease-in-out;
    }
    
    .heart1 {
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .heart2 {
        top: 15%;
        right: 10%;
        animation-delay: 2s;
    }
    
    .heart3 {
        bottom: 15%;
        left: 15%;
        animation-delay: 4s;
    }
    
    .heart4 {
        bottom: 10%;
        right: 15%;
        animation-delay: 6s;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) scale(1);
        }
        50% {
            transform: translateY(-15px) scale(1.1);
        }
    }
    
    .sparkles-container {
        position: relative;
        height: 0;
    }
    
    .sparkle {
        position: absolute;
        font-size: 1.2rem;
        animation: twinkle 3s infinite ease-in-out;
    }
    
    .sparkle1 {
        top: -60px;
        left: 25%;
        animation-delay: 0s;
    }
    
    .sparkle2 {
        top: -40px;
        left: 50%;
        animation-delay: 1s;
    }
    
    .sparkle3 {
        top: -60px;
        left: 75%;
        animation-delay: 2s;
    }
    
    @keyframes twinkle {
        0%, 100% {
            opacity: 0.5;
            transform: scale(0.8);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
    }
    
    .profile-title {
        text-align: center;
        color: #e83e8c;
        margin-bottom: 2.5rem;
        font-weight: 700;
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        text-shadow: 1px 1px 2px rgba(232, 62, 140, 0.2);
        position: relative;
        z-index: 2;
    }
    
    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2rem;
        padding: 2rem;
        background-color: #fef5f9;
        border-radius: 20px;
        border: 2px dashed #ffadd2;
        position: relative;
        z-index: 2;
    }
    
    @media (min-width: 768px) {
        .profile-card {
            flex-direction: row;
            align-items: flex-start;
        }
    }
    
    .profile-avatar {
        position: relative;
    }
    
    .avatar-frame {
        position: relative;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: linear-gradient(to bottom right, #ffadd2, #ff85a1);
        padding: 5px;
        box-shadow: 0 5px 15px rgba(232, 62, 140, 0.3);
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
    }
    
    .avatar-decoration {
        position: absolute;
        width: 190px;
        height: 190px;
        top: -10px;
        left: -10px;
        border-radius: 50%;
        border: 2px dotted #ffadd2;
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    .profile-info {
        flex: 1;
        padding: 1.5rem;
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    .profile-info h2 {
        color: #e83e8c;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .profile-emoji {
        margin-left: 0.5rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.8rem;
        background-color: #fef5f9;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        transform: translateX(5px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .info-icon {
        margin-right: 1rem;
        font-size: 1.2rem;
    }
    
    .info-text {
        color: #666;
        font-size: 1rem;
    }
    
    .verification-badge {
        position: relative;
        padding: 0.8rem;
        margin-bottom: 1rem;
        background-color: #e8f5e9;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .not-verified-badge {
        background-color: #ffebee;
    }
    
    .badge-sparkle {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 10px;
        height: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        animation: sparkleGlow 2s infinite;
    }
    
    @keyframes sparkleGlow {
        0%, 100% {
            box-shadow: 0 0 5px 2px rgba(77, 182, 172, 0.5);
        }
        50% {
            box-shadow: 0 0 10px 5px rgba(77, 182, 172, 0.8);
        }
    }
    
    .verified {
        color: #2e7d32;
        font-weight: 600;
        display: flex;
        align-items: center;
    }
    
    .not-verified {
        color: #c62828;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .buttons-container {
        display: flex;
        margin-top: 1.5rem;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    
    .edit-profile-btn, .logout-btn, .verify-email-btn {
        display: inline-block;
        padding: 0.7rem 1.3rem;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .edit-profile-btn {
        background: linear-gradient(to right, #ff85a1, #ff5d8f);
    }
    
    .logout-btn {
        background: linear-gradient(to right, #ffadd2, #ff85a1);
    }
    
    .verify-email-btn {
        background: linear-gradient(to right, #81c784, #66bb6a);
        margin-top: 0.5rem;
    }
    
    .edit-profile-btn:hover, .logout-btn:hover, .verify-email-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .profile-footer {
        position: relative;
        height: 40px;
        margin-top: 2rem;
    }
    
    .decoration {
        position: absolute;
        width: 100px;
        height: 20px;
        bottom: 0;
    }
    
    .decoration-left {
        left: 0;
        background: radial-gradient(circle at left, #ffadd2 10%, transparent 11%), 
                    radial-gradient(circle at left, #ffadd2 10%, transparent 11%);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
    
    .decoration-right {
        right: 0;
        background: radial-gradient(circle at right, #ffadd2 10%, transparent 11%), 
                    radial-gradient(circle at right, #ffadd2 10%, transparent 11%);
        background-size: 20px 20px;
        background-position: 0 0, 10px 10px;
    }
    
    /* Guest styles */
    .guest-message {
        text-align: center;
        background-color: #fef5f9;
        padding: 3rem 2rem;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(252, 186, 211, 0.3);
        position: relative;
    }
    
    .guest-message h2 {
        color: #e83e8c;
        margin-bottom: 2rem;
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
    }
    
    .guest-image {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 2rem;
    }
    
    .guest-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ffadd2;
        padding: 3px;
        background-color: white;
    }
    
    .avatar-glow {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,173,210,0.3), rgba(255,133,161,0.3));
        animation: glowPulse 3s infinite alternate;
    }
    
    @keyframes glowPulse {
        0% {
            transform: scale(1);
            opacity: 0.5;
        }
        100% {
            transform: scale(1.1);
            opacity: 0.2;
        }
    }
    
    .auth-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .login-btn, .register-btn {
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    .login-btn {
        background: linear-gradient(to right, #ff85a1, #ff5d8f);
        color: white;
    }
    
    .register-btn {
        background: linear-gradient(to right, #ffadd2, #ff85a1);
        color: white;
    }
    
    .login-btn:hover, .register-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }
    
    .logout-form {
        display: inline;
    }
</style>
@endpush