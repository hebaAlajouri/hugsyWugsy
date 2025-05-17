@extends('layouts.admin')

@section('content')
<h2>Create Order Item</h2>

<form action="{{ route('admin.order_items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Order</label>
        <select name="order_id" class="form-control">
            @foreach($orders as $order)
                <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
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

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="text" name="price" class="form-control" required>
    </div>

    <button class="btn btn-hugsy">Save</button>
</form>
@endsection
