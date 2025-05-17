@extends('layouts.admin')

@section('content')
    <h2>Add New Order</h2>

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                <option value="">Guest</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control">
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" step="0.01" name="total" class="form-control">
        </div>

        <button type="submit" class="btn btn-hugsy">Save</button>
    </form>
@endsection
