@extends('layouts.admin')

@section('content')
    <h2>Edit Order #{{ $order->id }}</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                <option value="">Guest</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $order->email }}">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $order->address }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $order->phone }}">
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control" value="{{ $order->payment_method }}">
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" step="0.01" name="total" class="form-control" value="{{ $order->total }}">
        </div>

        <button type="submit" class="btn btn-hugsy">Update</button>
    </form>
@endsection
