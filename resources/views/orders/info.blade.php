@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enter Your Information</h1>
    
    <form action="{{ route('order.storeInfo', ['order' => $order->id]) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $order->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $order->address) }}" required>
        </div>

        <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $order->phone) }}" required>
        </div>

        <div class="mb-3">
            <label for="payment_method">Payment Method:</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ old('payment_method', $order->payment_method) }}" required>
        </div>

        <div class="mb-3">
            <label for="total">Total:</label>
            <input type="text" name="total" id="total" class="form-control" value="{{ old('total', $order->total) }}" required readonly>
        </div>

        <button type="submit" class="btn btn-primary">Submit Information</button>
    </form>
</div>
@endsection
