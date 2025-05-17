@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Order Items</h1>

    <form action="{{ route('order-items.store') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="mb-3">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ number_format($product->price, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="0" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success">Add to Order</button>
    </form>
</div>
@endsection
