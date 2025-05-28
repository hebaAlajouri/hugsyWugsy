@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full mb-4 shadow-lg float">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent mb-2">
                Add Wishlist Entry
            </h2>
            <p class="text-gray-600 text-lg">Create a new wishlist item for your customer</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-pink-100 transform hover:scale-105 transition-all duration-500">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-pink-100 to-rose-100 px-8 py-6 border-b border-pink-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">New Wishlist Item</h3>
                        <p class="text-sm text-gray-600">Add something special to someone's dreams</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <form method="POST" action="{{ route('admin.wishlist.store') }}" class="space-y-8">
                    @csrf

                    <!-- User Selection -->
                    <div class="group">
                        <label class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            Choose Customer
                        </label>
                        <div class="relative transform group-hover:scale-102 transition-all duration-300">
                            <select name="user_id" 
                                    class="w-full px-4 py-4 bg-gradient-to-r from-pink-50 to-rose-50 border-2 border-pink-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-pink-200 focus:border-pink-400 transition-all duration-300 text-gray-700 font-medium appearance-none cursor-pointer hover:shadow-lg"
                                    required>
                                <option value="" disabled selected class="text-gray-400">Select a customer...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-pink-400 group-hover:text-pink-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center mt-2 ml-11">
                            <svg class="w-4 h-4 text-pink-300 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-gray-500">Who will receive this wishlist item?</p>
                        </div>
                    </div>

                    <!-- Product Selection -->
                    <div class="group">
                        <label class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-rose-400 to-pink-400 rounded-full flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            Select Product
                        </label>
                        <div class="relative transform group-hover:scale-102 transition-all duration-300">
                            <select name="product_id" 
                                    class="w-full px-4 py-4 bg-gradient-to-r from-pink-50 to-rose-50 border-2 border-pink-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-pink-200 focus:border-pink-400 transition-all duration-300 text-gray-700 font-medium appearance-none cursor-pointer hover:shadow-lg"
                                    required>
                                <option value="" disabled selected class="text-gray-400">Choose a product...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="w-5 h-5 text-pink-400 group-hover:text-pink-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center mt-2 ml-11">
                            <svg class="w-4 h-4 text-pink-300 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <p class="text-sm text-gray-500">What product do they dream of having?</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8">
                        <button type="submit" 
                                class="flex-1 group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 hover:from-pink-600 hover:to-rose-600 focus:outline-none focus:ring-4 focus:ring-pink-300 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-400 to-rose-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="w-6 h-6 mr-3 relative z-10 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span class="relative z-10">Save to Wishlist</span>
                        </button>
                        
                        <a href="{{ route('admin.wishlist.index') }}" 
                           class="flex-1 group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-400 to-gray-500 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 hover:from-gray-500 hover:to-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-300 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-gray-300 to-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="w-6 h-6 mr-3 relative z-10 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span class="relative z-10">Cancel</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Card Footer with motivational message -->
            <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-8 py-4 border-t border-pink-100">
                <div class="flex items-center justify-center text-sm text-gray-600">
                    <svg class="w-5 h-5 mr-2 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span class="font-medium">Making dreams come true, one wishlist at a time ✨</span>
                </div>
            </div>
        </div>

        <!-- Floating Hearts Animation -->
        <div class="fixed top-20 left-10 opacity-20 pointer-events-none">
            <div class="w-6 h-6 text-pink-300 float-slow">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        </div>
        
        <div class="fixed top-40 right-20 opacity-20 pointer-events-none">
            <div class="w-4 h-4 text-rose-300 float-medium">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="flex justify-center mt-12 space-x-4">
            <div class="w-3 h-3 bg-pink-300 rounded-full animate-pulse"></div>
            <div class="w-4 h-4 bg-rose-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
            <div class="w-3 h-3 bg-purple-300 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
        </div>
    </div>
</div>

<style>
/* Custom animations and effects */
.float {
    animation: float 4s ease-in-out infinite;
}

.float-slow {
    animation: float 6s ease-in-out infinite;
}

.float-medium {
    animation: float 4s ease-in-out infinite 2s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

/* Enhanced select styling */
select option {
    background: white;
    color: #374151;
    padding: 12px;
    border-radius: 8px;
    margin: 2px;
}

select option:checked {
    background: linear-gradient(45deg, #fce7f3, #fdf2f8);
    color: #be185d;
    font-weight: 600;
}

select option:hover {
    background: #fce7f3;
}

/* Group hover effects */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:scale-102 {
    transform: scale(1.02);
}

/* Button ripple effect */
@keyframes ripple {
    0% { transform: scale(0); opacity: 1; }
    100% { transform: scale(4); opacity: 0; }
}

button:active::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transform: translate(-50%, -50%);
    animation: ripple 0.6s ease-out;
}

/* Focus states for accessibility */
button:focus, select:focus, a:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.3);
}

/* Smooth transitions for all elements */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #fdf2f8;
    border-radius: 10px;
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