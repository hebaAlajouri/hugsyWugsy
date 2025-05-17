@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Add Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <input type="text" name="name" class="form-control mb-2" placeholder="Name">
        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price">
        <input type="text" name="image" class="form-control mb-2" placeholder="Image path (optional)">
        <input type="text" name="category" class="form-control mb-2" placeholder="Category">
        <label><input type="checkbox" name="is_customizable" value="1"> Is Customizable?</label><br><br>
        <button class="btn btn-hugsy">Save</button>
    </form>
@endsection
