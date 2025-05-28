@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4" style="color: #D36BA6; font-weight: bold;">💌 Add New Message</h2>

    <form action="{{ route('messages.store') }}" method="POST" class="p-4 rounded shadow-sm" style="background-color: #FFF0F6;">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label" style="color: #AD4C8C;">👧 Name</label>
            <input type="text" name="name" id="name" class="form-control"
                style="border: 2px dashed #F5A9C0; background-color: #FFF8FB;" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label" style="color: #AD4C8C;">📧 Email</label>
            <input type="email" name="email" id="email" class="form-control"
                style="border: 2px dashed #F5A9C0; background-color: #FFF8FB;" required>
        </div>

        <!-- Subject -->
        <div class="mb-3">
            <label for="subject" class="form-label" style="color: #AD4C8C;">🎀 Subject</label>
            <input type="text" name="subject" id="subject" class="form-control"
                style="border: 2px dashed #F5A9C0; background-color: #FFF8FB;" required>
        </div>

        <!-- Message -->
        <div class="mb-4">
            <label for="message" class="form-label" style="color: #AD4C8C;">📝 Message</label>
            <textarea name="message" id="message" rows="4" class="form-control"
                style="border: 2px dashed #F5A9C0; background-color: #FFF8FB;" required></textarea>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="btn" style="background-color: #F5A9C0; color: white; font-weight: bold; padding: 10px 30px; border-radius: 30px;">
                💾 Save Message
            </button>
        </div>
    </form>
</div>
@endsection
