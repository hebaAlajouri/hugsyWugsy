@extends('layouts.app')

@section('title', 'Edit Profile | HugsyWugsy')

@section('content')
<div class="edit-profile-container">
    @auth
        <h1 class="edit-profile-title">✨ Edit Your Profile ✨</h1>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">
                <span class="heart-icon">💖</span> Profile updated successfully! <span class="heart-icon">💖</span>
            </div>
        @endif

        <div class="profile-form-card">
            <form method="POST" action="{{ route('profile.update') }}" class="edit-profile-form">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required autofocus>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" id="role" name="role" value="{{ old('role', Auth::user()->role) }}" placeholder="e.g. Member, Admin, etc.">
                    @error('role')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="buttons-row">
                    <button type="submit" class="save-btn">💗 Save Changes</button>
                    <a href="{{ route('profile.show') }}" class="cancel-btn">🌸 Cancel</a>
                </div>
            </form>

            <div class="password-section">
                <h2>💅 Update Password</h2>
                <form method="POST" action="{{ route('password.update') }}" class="password-form">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="password-btn">🔐 Update Password</button>
                </form>
            </div>

            <div class="danger-zone">
                <h2>⚠️ Danger Zone</h2>
                <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                
                <button type="button" class="delete-btn" onclick="toggleDeleteForm()">❗ Delete Account</button>
                
                <form id="delete-form" method="POST" action="{{ route('profile.destroy') }}" class="delete-form" style="display: none;">
                    @csrf
                    @method('delete')
                    
                    <div class="form-group">
                        <label for="delete_password">Password</label>
                        <input type="password" id="delete_password" name="password" required>
                        @error('password', 'userDeletion')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="confirm-delete">
                        <button type="submit" class="confirm-delete-btn">Confirm Delete</button>
                        <button type="button" class="cancel-delete-btn" onclick="toggleDeleteForm()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="guest-message">
            <h2>💝 Please login to edit your profile</h2>
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="login-btn">🌷 Login</a>
                <a href="{{ route('register') }}" class="register-btn">✏️ Register</a>
            </div>
        </div>
    @endauth
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<style>
    .edit-profile-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 1.5rem;
        font-family: 'Poppins', sans-serif;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M50 10 C60 10 60 30 50 30 C40 30 40 10 50 10 Z"/><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M30 30 C40 30 40 50 30 50 C20 50 20 30 30 30 Z"/><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M70 30 C80 30 80 50 70 50 C60 50 60 30 70 30 Z"/><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M50 50 C60 50 60 70 50 70 C40 70 40 50 50 50 Z"/><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M30 70 C40 70 40 90 30 90 C20 90 20 70 30 70 Z"/><path fill="none" stroke="%23FFD1DC" stroke-width="2" d="M70 70 C80 70 80 90 70 90 C60 90 60 70 70 70 Z"/></svg>');
        background-repeat: repeat;
        background-size: 200px;
        position: relative;
    }
    
    .edit-profile-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: -1;
    }
    
    .edit-profile-title {
        text-align: center;
        color: #FF69B4;
        margin-bottom: 2rem;
        font-weight: 700;
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        letter-spacing: 1px;
    }
    
    .profile-form-card {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(255, 105, 180, 0.15);
        padding: 2rem;
        border: 2px solid #FFD1DC;
        position: relative;
    }
    
    /* Decorative elements */
    .profile-form-card::before,
    .profile-form-card::after {
        content: "✿";
        position: absolute;
        color: #FF69B4;
        font-size: 1.5rem;
    }
    
    .profile-form-card::before {
        top: 10px;
        left: 10px;
    }
    
    .profile-form-card::after {
        bottom: 10px;
        right: 10px;
    }
    
    .alert {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 15px;
        text-align: center;
    }
    
    .alert-success {
        background-color: #FFE6F2;
        color: #D2436C;
        border: 1px solid #FFCCE5;
    }
    
    .heart-icon {
        margin: 0 5px;
        display: inline-block;
        animation: beat 1s infinite alternate;
    }
    
    @keyframes beat {
        to { transform: scale(1.2); }
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #FF69B4;
        font-size: 1.1rem;
    }
    
    .form-group input {
        width: 100%;
        padding: 0.85rem;
        border: 2px solid #FFD1DC;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #FFF8FA;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #FF69B4;
        box-shadow: 0 0 10px rgba(255, 105, 180, 0.25);
        background-color: #fff;
    }
    
    .error-message {
        color: #F06292;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }
    
    .buttons-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        justify-content: center;
    }
    
    .save-btn, .cancel-btn, .password-btn {
        padding: 0.7rem 1.8rem;
        border-radius: 30px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .save-btn {
        background: linear-gradient(45deg, #FF69B4, #FFB6C1);
        color: white;
    }
    
    .cancel-btn {
        background: linear-gradient(45deg, #FFECF2, #FFDCE8);
        color: #FF69B4;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .password-btn {
        background: linear-gradient(45deg, #F48FB1, #FF80AB);
        color: white;
        width: auto;
        display: block;
        margin: 0 auto;
    }
    
    .save-btn:hover, .password-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(255, 105, 180, 0.3);
    }
    
    .cancel-btn:hover {
        background: linear-gradient(45deg, #FFE0EB, #FFD0E0);
        transform: translateY(-3px);
    }
    
    .password-section {
        margin-top: 2.5rem;
        padding-top: 2.5rem;
        border-top: 2px dashed #FFD1DC;
        position: relative;
    }
    
    .password-section::before {
        content: "❀ ❀ ❀";
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        padding: 0 15px;
        color: #FF69B4;
        font-size: 14px;
    }
    
    .password-section h2, .danger-zone h2 {
        text-align: center;
        margin-bottom: 1.8rem;
        font-family: 'Dancing Script', cursive;
        font-size: 2rem;
    }
    
    .password-section h2 {
        color: #FF69B4;
    }
    
    .danger-zone {
        margin-top: 2.5rem;
        padding-top: 2.5rem;
        border-top: 2px dashed #FFD1DC;
        position: relative;
    }
    
    .danger-zone::before {
        content: "❀ ❀ ❀";
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        padding: 0 15px;
        color: #FF69B4;
        font-size: 14px;
    }
    
    .danger-zone h2 {
        color: #F06292;
    }
    
    .danger-zone p {
        margin-bottom: 1.5rem;
        color: #666;
        text-align: center;
        font-style: italic;
    }
    
    .delete-btn {
        background: linear-gradient(45deg, #F48FB1, #F06292);
        color: white;
        padding: 0.7rem 1.8rem;
        border-radius: 30px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        margin: 0 auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .delete-btn:hover {
        background: linear-gradient(45deg, #F06292, #EC407A);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(240, 98, 146, 0.3);
    }
    
    .delete-form {
        margin-top: 1.5rem;
        padding: 1.5rem;
        background-color: #FFF0F5;
        border-radius: 15px;
        border: 1px solid #FFCCE5;
    }
    
    .confirm-delete {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 1.5rem;
    }
    
    .confirm-delete-btn {
        background: linear-gradient(45deg, #F06292, #E91E63);
        color: white;
        padding: 0.7rem 1.8rem;
        border-radius: 30px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .confirm-delete-btn:hover {
        background: linear-gradient(45deg, #E91E63, #D81B60);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(233, 30, 99, 0.3);
    }
    
    .cancel-delete-btn {
        background: linear-gradient(45deg, #FFECF2, #FFDCE8);
        color: #F06292;
        padding: 0.7rem 1.8rem;
        border-radius: 30px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .cancel-delete-btn:hover {
        background: linear-gradient(45deg, #FFE0EB, #FFD0E0);
        transform: translateY(-3px);
    }
    
    .guest-message {
        text-align: center;
        background-color: #fff;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(255, 105, 180, 0.15);
        border: 2px solid #FFD1DC;
    }
    
    .guest-message h2 {
        color: #FF69B4;
        font-family: 'Dancing Script', cursive;
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
    }
    
    .auth-buttons {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin-top: 1.8rem;
    }
    
    .login-btn, .register-btn {
        padding: 0.8rem 2.2rem;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-size: 1.1rem;
    }
    
    .login-btn {
        background: linear-gradient(45deg, #FF69B4, #FFB6C1);
        color: white;
    }
    
    .register-btn {
        background: linear-gradient(45deg, #A5D6A7, #81C784);
        color: white;
    }
    
    .login-btn:hover, .register-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleDeleteForm() {
        const deleteForm = document.getElementById('delete-form');
        if (deleteForm.style.display === 'none') {
            deleteForm.style.display = 'block';
        } else {
            deleteForm.style.display = 'none';
        }
    }
</script>
@endpush