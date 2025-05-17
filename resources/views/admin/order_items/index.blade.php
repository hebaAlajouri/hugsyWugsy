@extends('layouts.admin')

@section('content')
<h2>Order Items</h2>
<a href="{{ route('admin.order_items.create') }}" class="btn btn-hugsy mb-3">Add Order Item</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>#{{ $item->order_id }}</td>
                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price }}</td>
                <td>
                    <a href="{{ route('admin.order_items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.order_items.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
