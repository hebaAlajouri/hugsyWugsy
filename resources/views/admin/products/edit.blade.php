@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Edit Product</h2>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}">
        <textarea name="description" class="form-control mb-2">{{ $product->description }}</textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" value="{{ $product->price }}">
        <input type="text" name="image" class="form-control mb-2" value="{{ $product->image }}">
        <input type="text" name="category" class="form-control mb-2" value="{{ $product->category }}">
        <label><input type="checkbox" name="is_customizable" value="1" {{ $product->is_customizable ? 'checked' : '' }}> Is Customizable?</label><br><br>
        <button class="btn btn-hugsy">Update</button>
    </form>
@endsection
