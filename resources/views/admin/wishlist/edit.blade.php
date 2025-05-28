@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-2">
                Edit Wishlist Entry
            </h2>
            <p class="text-gray-600 text-lg">Update your customer's wishlist item</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-pink-100">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-pink-100 to-rose-100 px-8 py-6 border-b border-pink-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Wishlist Details</h3>
                        <p class="text-sm text-gray-600">Make changes to this wishlist entry</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form method="POST" action="{{ route('admin.wishlist.update', $wishlist->id) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- User Selection -->
                    <div class="space-y-3">
                        <label class="flex items-center text-lg font-semibold text-gray-700 mb-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            Customer
                        </label>
                        <div class="relative">
                            <select name="user_id" 
                                    class="w-full px-4 py-4 bg-gradient-to-r from-pink-50 to-rose-50 border-2 border-pink-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-pink-200 focus:border-pink-400 transition-all duration-300 text-gray-700 font-medium appearance-none cursor-pointer">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $wishlist->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 ml-11">Select the customer who owns this wishlist</p>
                    </div>

                    <!-- Product Selection -->
                    <div class="space-y-3">
                        <label class="flex items-center text-lg font-semibold text-gray-700 mb-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-rose-400 to-pink-400 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            Product
                        </label>
                        <div class="relative">
                            <select name="product_id" 
                                    class="w-full px-4 py-4 bg-gradient-to-r from-pink-50 to-rose-50 border-2 border-pink-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-pink-200 focus:border-pink-400 transition-all duration-300 text-gray-700 font-medium appearance-none cursor-pointer">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $wishlist->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 ml-11">Choose the product for this wishlist entry</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-pink-600 hover:to-rose-600 focus:outline-none focus:ring-4 focus:ring-pink-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Update Wishlist
                        </button>
                        
                        <a href="{{ route('admin.wishlist.index') }}" 
                           class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-gray-500 hover:to-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <!-- Card Footer -->
            <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-8 py-4 border-t border-pink-100">
                <div class="flex items-center justify-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Changes will be saved immediately after clicking Update
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="flex justify-center mt-12 space-x-4">
            <div class="w-3 h-3 bg-pink-300 rounded-full animate-bounce"></div>
            <div class="w-3 h-3 bg-rose-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
            <div class="w-3 h-3 bg-purple-300 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
        </div>
    </div>
</div>

<style>
/* Custom styles for enhanced femininity */
.form-control:focus {
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
    border-color: #ec4899;
}

/* Custom select dropdown styling */
select option {
    background: white;
    color: #374151;
    padding: 10px;
}

select option:checked {
    background: linear-gradient(45deg, #fce7f3, #fdf2f8);
    color: #be185d;
}

/* Floating animation for decorative elements */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.float {
    animation: float 3s ease-in-out infinite;
}

/* Enhanced button hover effects */
button:hover, a:hover {
    transform: translateY(-2px) scale(1.02);
}

/* Focus states for accessibility */
button:focus, select:focus, a:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.2);
}

/* Smooth transitions */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endsection