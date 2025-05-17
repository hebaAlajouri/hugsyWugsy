@extends('layouts.admin')

@section('content')
    <h2>Manage Orders</h2>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-hugsy mb-3">Add New Order</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Total</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user ? $order->user->name : 'Guest' }}</td> <!-- Replace full_name with user name -->
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>${{ $order->total }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
