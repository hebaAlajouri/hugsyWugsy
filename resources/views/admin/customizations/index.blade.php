@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mb-4 shadow-lg float">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10a4 4 0 00-4-4H7"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                Product Customizations
            </h2>
            <p class="text-gray-600 text-lg">Manage your customers' personalized product requests</p>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-6 rounded-2xl shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-400 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <p class="text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Add Button -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.customizations.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:from-purple-600 hover:to-pink-600">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add Customization
            </a>
        </div>

        <!-- Customizations Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($customizations as $item)
            <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 overflow-hidden border border-purple-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-purple-100 to-pink-100 px-6 py-4 border-b border-purple-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">#{{ $item->id }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $item->user->name ?? 'Unknown User' }}</h3>
                                <p class="text-sm text-gray-600">Customer</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10a4 4 0 00-4-4H7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-6 py-6 space-y-4">
                    <!-- Product -->
                    <div>
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Product
                        </label>
                        <p class="text-lg font-semibold text-gray-800 mt-1">{{ $item->product->name ?? 'N/A' }}</p>
                    </div>

                    <!-- Color -->
                    <div>
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                            </svg>
                            Color
                        </label>
                        <div class="flex items-center mt-1">
                            <div class="w-4 h-4 rounded-full mr-2 border-2 border-gray-200" style="background-color: {{ $item->color ?? '#e5e5e5' }}"></div>
                            <p class="text-gray-800 font-medium">{{ $item->color ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <!-- Accessories -->
                    <div>
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Accessories
                        </label>
                        <p class="text-gray-800 mt-1">{{ $item->accessories ?? 'None specified' }}</p>
                    </div>

                    <!-- Instructions -->
                    @if($item->special_instructions)
                    <div>
                        <label class="text-sm font-medium text-gray-500 uppercase tracking-wide flex items-center">
                            <svg class="w-4 h-4 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Special Instructions
                        </label>
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-3 mt-1">
                            <p class="text-gray-700 text-sm italic">{{ Str::limit($item->special_instructions, 100) }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="px-6 pb-6">
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.customizations.edit', $item) }}" 
                           class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-indigo-400 to-purple-400 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 hover:from-indigo-500 hover:to-purple-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        
                        <form action="{{ route('admin.customizations.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this customization?')">
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
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-3 border-t border-purple-100">
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            Customization Request
                        </span>
                        @if($item->created_at)
                        <span>{{ $item->created_at->diffForHumans() }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($customizations->isEmpty())
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full mb-6">
                <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10a4 4 0 00-4-4H7"/>
                </svg>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">No Customizations Yet</h3>
            <p class="text-gray-600 mb-6">Start creating personalized products for your customers!</p>
            <a href="{{ route('admin.customizations.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Add First Customization
            </a>
        </div>
        @endif

        <!-- Floating Decorative Elements -->
        <div class="fixed top-20 left-10 opacity-10 pointer-events-none">
            <div class="w-8 h-8 text-purple-300 float-slow">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 3V1m0 18v2m8-10a4 4 0 00-4-4H7"/>
                </svg>
            </div>
        </div>
        
        <div class="fixed top-40 right-20 opacity-10 pointer-events-none">
            <div class="w-6 h-6 text-pink-300 float-medium">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                </svg>
            </div>
        </div>

        <!-- Bottom Decorative Elements -->
        <div class="flex justify-center mt-12 space-x-4">
            <div class="w-3 h-3 bg-purple-300 rounded-full animate-pulse"></div>
            <div class="w-4 h-4 bg-pink-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
            <div class="w-3 h-3 bg-indigo-300 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
        </div>
    </div>
</div>

<style>
/* Custom animations */
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
    50% { transform: translateY(-15px) rotate(3deg); }
}

/* Card hover effects */
.card-hover:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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
button:focus, a:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(147, 51, 234, 0.3);
}

/* Smooth transitions */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f3e8ff;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #8b5cf6, #ec4899);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #7c3aed, #db2777);
}

/* Enhanced color display */
.color-display {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.8);
}
</style>
@endsection