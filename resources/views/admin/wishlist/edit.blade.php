@extends('layouts.admin')

@section('content')
<h2>Edit Wishlist Entry</h2>
<form method="POST" action="{{ route('admin.wishlist.update', $wishlist->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $wishlist->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Product</label>
        <select name="product_id" class="form-control">
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $wishlist->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-hugsy">Update</button>
</form>
@endsection
