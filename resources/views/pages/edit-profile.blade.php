@extends('layouts.app')

@section('title', 'Edit Profile | HugsyWugsy')

@section('content')

<div class="profile-edit-container">
    <h1 class="profile-edit-title">🐻 Edit Your Profile 🐻</h1>

    <form action="{{ route('pages.profile.update') }}" method="POST" class="profile-edit-form">
        @csrf

        <div class="form-group">
            <label>👤 Name:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label>📧 Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label>🔒 New Password: (Leave blank if not changing)</label>
            <input type="password" name="password">
        </div>

        <div class="form-group">
            <label>🔒 Confirm New Password:</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit" class="save-btn">💾 Save Changes</button>
        
    </form>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
