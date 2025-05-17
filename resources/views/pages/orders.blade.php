@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-pink-500 mb-6">📦 My Orders</h1>

    <div class="grid gap-6">
        @foreach ($orders as $order)
            <div class="bg-pink-50 border border-pink-200 p-4 rounded-2xl shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                        <p><strong>Status:</strong> <span class="text-green-600">{{ $order->status }}</span></p>
                    </div>
                    <a href="{{ route('orders.show', $order->id) }}" class="text-white bg-pink-400 hover:bg-pink-500 px-4 py-2 rounded-xl transition">
                        View Items
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
