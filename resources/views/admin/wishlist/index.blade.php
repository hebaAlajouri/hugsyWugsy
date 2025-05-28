@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-2">
                Wishlist Management
            </h1>
            <p class="text-gray-600 text-lg">Manage your customers' dream collections</p>
        </div>

        <!-- Add Button -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.wishlist.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-pink-600 hover:to-rose-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add to Wishlist
            </a>
        </div>

        <!-- Wishlist Cards -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($wishlist as $item)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-pink-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-pink-100 to-rose-100 px-6 py-4 border-b border-pink-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $item->user->name ?? 'Unknown User' }}</h3>
                                <p class="text-sm text-gray-600">Customer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-6 py-6">
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide">Product</label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ $item->product->name ?? 'Unknown Product' }}</p>
                    </div>

                    <!-- Product Details (if available) -->
                    @if($item->product)
                    <div class="flex items-center space-x-4 text-sm text-gray-600 mb-6">
                        @if($item->product->price)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            ${{ number_format($item->product->price, 2) }}
                        </span>
                        @endif
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            Wishlist Item
                        </span>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.wishlist.edit', $item->id) }}" 
                           class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-purple-400 to-pink-400 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 hover:from-purple-500 hover:to-pink-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.wishlist.destroy', $item->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to remove this item from the wishlist?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-rose-400 to-red-400 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 hover:from-rose-500 hover:to-red-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-6 py-3 border-t border-pink-100">
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Added to wishlist</span>
                        @if($item->created_at)
                        <span>{{ $item->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($wishlist->isEmpty())
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-pink-100 to-rose-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">No Wishlist Items Yet</h3>
            <p class="text-gray-600 mb-6">Start building your customers' dream collections!</p>
            <a href="{{ route('admin.wishlist.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add First Item
            </a>
        </div>
        @endif
    </div>
</div>

<style>
/* Additional custom styles for enhanced femininity */
.card-hover:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Soft animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.float-animation {
    animation: float 6s ease-in-out infinite;
}

/* Custom scrollbar for webkit browsers */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #fdf2f8;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #ec4899, #f43f5e);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #db2777, #e11d48);
}
</style>
@endsection