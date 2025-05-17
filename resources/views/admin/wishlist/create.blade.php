@extends('layouts.admin')

@section('content')
<h2>Add Wishlist Entry</h2>
<form method="POST" action="{{ route('admin.wishlist.store') }}">
    @csrf

    <div class="mb-3">
        <label>User</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Product</label>
        <select name="product_id" class="form-control">
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-hugsy">Save</button>
</form>
@endsection
