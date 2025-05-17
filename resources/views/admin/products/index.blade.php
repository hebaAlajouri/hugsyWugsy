@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-hugsy mb-3">Add New Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Description</th><th>Price</th><th>Category</th><th>Customizable</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td><td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td><td>{{ $product->category }}</td>
                    <td>{{ $product->is_customizable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
