@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #a83265;">Add Customization</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.customizations.store') }}" method="POST" class="form-container">
        @csrf

        <div class="mb-3">
            <label for="user_id" style="color: #a83265; font-weight: bold;">User</label>
            <select id="user_id" name="user_id" class="form-control rounded-pill" style="background-color: #ffe2ec;">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id" style="color: #a83265; font-weight: bold;">Product</label>
            <select id="product_id" name="product_id" class="form-control rounded-pill" style="background-color: #ffe2ec;">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name ?? 'Product #' . $product->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="color" style="color: #a83265; font-weight: bold;">Color</label>
            <input type="text" id="color" name="color" class="form-control rounded-pill" placeholder="e.g., Pink" style="background-color: #ffe2ec;">
        </div>

        <div class="mb-3">
            <label for="text" style="color: #a83265; font-weight: bold;">Text</label>
            <input type="text" id="text" name="text" class="form-control rounded-pill" placeholder="Custom text" style="background-color: #ffe2ec;">
        </div>

        <div class="mb-3">
            <label for="accessories" style="color: #a83265; font-weight: bold;">Accessories</label>
            <textarea id="accessories" name="accessories" class="form-control rounded-pill" rows="2" placeholder="Bow, Hat, Glasses..." style="background-color: #ffe2ec;"></textarea>
        </div>

        <div class="mb-3">
            <label for="special_instructions" style="color: #a83265; font-weight: bold;">Special Instructions</label>
            <textarea id="special_instructions" name="special_instructions" class="form-control rounded-pill" rows="3" style="background-color: #ffe2ec;"></textarea>
        </div>

        <div class="mb-3">
            <label for="voice_note" style="color: #a83265; font-weight: bold;">Voice Note (filename)</label>
            <input type="text" id="voice_note" name="voice_note" class="form-control rounded-pill" placeholder="voice_note_123.mp3" style="background-color: #ffe2ec;">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-hugsy rounded-pill w-100">Save Customization</button>
        </div>
    </form>
</div>
@endsection
