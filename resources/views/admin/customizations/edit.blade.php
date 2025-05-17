@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Customization #{{ $customization->id }}</h2>

    <form action="{{ route('admin.customizations.update', $customization) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $customization->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $customization->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name ?? 'Product #' . $product->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Color</label>
            <input type="text" name="color" class="form-control" value="{{ $customization->color }}">
        </div>

        <div class="mb-3">
            <label>Text</label>
            <input type="text" name="text" class="form-control" value="{{ $customization->text }}">
        </div>

        <div class="mb-3">
            <label>Accessories</label>
            <textarea name="accessories" class="form-control" rows="2">{{ $customization->accessories }}</textarea>
        </div>

        <div class="mb-3">
            <label>Special Instructions</label>
            <textarea name="special_instructions" class="form-control" rows="3">{{ $customization->special_instructions }}</textarea>
        </div>

        <div class="mb-3">
            <label>Voice Note (filename)</label>
            <input type="text" name="voice_note" class="form-control" value="{{ $customization->voice_note }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.customizations.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
