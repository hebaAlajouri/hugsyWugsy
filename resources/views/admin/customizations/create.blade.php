@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-pink-50 via-rose-50 to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-pink-400 to-rose-400 rounded-full mb-4 shadow-lg animate-pulse">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Add New Customization</h1>
            <p class="text-rose-600 font-medium">Create something beautiful and unique</p>
            <div class="w-24 h-1 bg-gradient-to-r from-pink-400 to-rose-400 mx-auto rounded-full mt-3"></div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-400 rounded-r-2xl p-6 shadow-sm">
                <div class="flex items-center mb-3">
                    <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-red-800 font-semibold">Please fix the following issues:</h3>
                </div>
                <ul class="list-disc list-inside space-y-1 text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-pink-100 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-400 via-rose-400 to-purple-400 p-6">
                <h2 class="text-white text-xl font-semibold flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Design Your Perfect Creation
                </h2>
            </div>

            <form action="{{ route('admin.customizations.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- User Selection -->
                    <div class="space-y-3">
                        <label for="user_id" class="flex items-center text-gray-700 font-semibold text-lg">
                            <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            Customer
                        </label>
                        <select id="user_id" name="user_id" class="w-full px-4 py-3 border-2 border-pink-200 rounded-2xl focus:border-rose-400 focus:ring-4 focus:ring-rose-100 transition-all duration-300 bg-gradient-to-r from-pink-50 to-rose-50 shadow-sm hover:shadow-md">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Selection -->
                    <div class="space-y-3">
                        <label for="product_id" class="flex items-center text-gray-700 font-semibold text-lg">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            Product
                        </label>
                        <select id="product_id" name="product_id" class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 bg-gradient-to-r from-purple-50 to-pink-50 shadow-sm hover:shadow-md">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name ?? 'Product #' . $product->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Color and Text Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Color Selection -->
                    <div class="space-y-3">
                        <label for="color" class="flex items-center text-gray-700 font-semibold text-lg">
                            <div class="w-8 h-8 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM7 21h10a2 2 0 002-2v-4a2 2 0 00-2-2H7"></path>
                                </svg>
                            </div>
                            Color Choice
                        </label>
                        <input type="text" id="color" name="color" 
                               class="w-full px-4 py-3 border-2 border-pink-200 rounded-2xl focus:border-rose-400 focus:ring-4 focus:ring-rose-100 transition-all duration-300 bg-gradient-to-r from-pink-50 to-rose-50 shadow-sm hover:shadow-md"
                               placeholder="e.g., Blush Pink, Lavender, Rose Gold...">
                    </div>

                    <!-- Text Input -->
                    <div class="space-y-3">
                        <label for="text" class="flex items-center text-gray-700 font-semibold text-lg">
                            <div class="w-8 h-8 bg-rose-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            Custom Text
                        </label>
                        <input type="text" id="text" name="text" 
                               class="w-full px-4 py-3 border-2 border-rose-200 rounded-2xl focus:border-pink-400 focus:ring-4 focus:ring-pink-100 transition-all duration-300 bg-gradient-to-r from-rose-50 to-pink-50 shadow-sm hover:shadow-md"
                               placeholder="Your special message or name...">
                    </div>
                </div>

                <!-- Accessories Section -->
                <div class="space-y-3">
                    <label for="accessories" class="flex items-center text-gray-700 font-semibold text-lg">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        Accessories & Add-ons
                    </label>
                    <textarea id="accessories" name="accessories" rows="4" 
                              class="w-full px-4 py-3 border-2 border-purple-200 rounded-2xl focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 resize-none bg-gradient-to-r from-purple-50 to-pink-50 shadow-sm hover:shadow-md"
                              placeholder="Bow, Hat, Glasses, Jewelry, Ribbons, Sparkles..."></textarea>
                </div>

                <!-- Special Instructions -->
                <div class="space-y-3">
                    <label for="special_instructions" class="flex items-center text-gray-700 font-semibold text-lg">
                        <div class="w-8 h-8 bg-gradient-to-r from-rose-300 to-purple-300 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        Special Instructions
                    </label>
                    <textarea id="special_instructions" name="special_instructions" rows="4" 
                              class="w-full px-4 py-3 border-2 border-rose-200 rounded-2xl focus:border-rose-400 focus:ring-4 focus:ring-rose-100 transition-all duration-300 resize-none bg-gradient-to-r from-rose-50 to-purple-50 shadow-sm hover:shadow-md"
                              placeholder="Any special requests, preferred styles, or detailed instructions..."></textarea>
                </div>

                <!-- Voice Note Section -->
                <div class="space-y-3">
                    <label for="voice_note" class="flex items-center text-gray-700 font-semibold text-lg">
                        <div class="w-8 h-8 bg-gradient-to-r from-pink-300 to-rose-300 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                            </svg>
                        </div>
                        Voice Note
                    </label>
                    <input type="text" id="voice_note" name="voice_note" 
                           class="w-full px-4 py-3 border-2 border-pink-200 rounded-2xl focus:border-pink-400 focus:ring-4 focus:ring-pink-100 transition-all duration-300 bg-gradient-to-r from-pink-50 to-rose-50 shadow-sm hover:shadow-md"
                           placeholder="voice_note_123.mp3">
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-pink-100">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center text-lg">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Save Customization
                        <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Decorative Elements -->
        <div class="fixed top-10 left-10 w-20 h-20 bg-pink-200 rounded-full opacity-20 animate-bounce"></div>
        <div class="fixed top-32 right-20 w-16 h-16 bg-purple-200 rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="fixed bottom-20 left-20 w-12 h-12 bg-rose-200 rounded-full opacity-20 animate-ping" style="animation-delay: 2s;"></div>
        <div class="fixed bottom-32 right-10 w-14 h-14 bg-pink-300 rounded-full opacity-15 animate-bounce" style="animation-delay: 0.5s;"></div>

        <!-- Floating Hearts -->
        <div class="fixed top-1/4 left-1/4 opacity-10">
            <svg class="w-8 h-8 text-pink-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
        <div class="fixed top-3/4 right-1/4 opacity-10">
            <svg class="w-6 h-6 text-rose-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24" style="animation-delay: 1.5s;">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Custom scrollbar for textareas */
    textarea::-webkit-scrollbar {
        width: 8px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #f472b6, #ec4899);
        border-radius: 10px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #ec4899, #db2777);
    }
    
    /* Enhanced focus states */
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(244, 114, 182, 0.1);
    }
    
    /* Button hover glow effect */
    button[type="submit"]:hover {
        box-shadow: 0 20px 40px rgba(244, 114, 182, 0.3);
    }
</style>
@endsection