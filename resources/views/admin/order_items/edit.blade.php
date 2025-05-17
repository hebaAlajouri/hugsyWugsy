@extends('layouts.admin')

@section('content')
<h2>Edit Order Item</h2>

<form action="{{ route('admin.order_items.update', $order_item->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Order</label>
        <select name="order_id" class="form-control">
            @foreach($orders as $order)
                <option value="{{ $order->id }}" @selected($order->id == $order_item->order_id)>
                    Order #{{ $order->id }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Product</label>
        <select name="product_id" class="form-control">
            @foreach($products as $product)
                <option value="{{ $product->id }}" @selected($product->id == $order_item->product_id)>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $order_item->quantity }}">
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="text" name="price" class="form-control" value="{{ $order_item->price }}">
    </div>

    <button class="btn btn-hugsy">Update</button>
</form>
@endsection
