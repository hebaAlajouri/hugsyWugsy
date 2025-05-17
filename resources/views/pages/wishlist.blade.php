@extends('layouts.app')

@section('title', 'My Lovely Wishlist')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-pink-50 rounded-lg shadow-lg p-6 max-w-5xl mx-auto">
        <h1 class="text-4xl font-bold text-center text-pink-500 mb-1">My Lovely Wishlist</h1>
        <p class="text-center text-purple-600 mb-8">All your favorite cuddly friends in one place!</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($wishlistItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="{{ asset('images/products/' . ($product->image ?? 'default.jpg')) }}" 
                                alt="{{ $product->name }}" class="w-full h-64 object-cover">
                            
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-pink-500 hover:text-pink-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-pink-600 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                            <p class="text-lg font-bold text-purple-600 mb-4">${{ number_format($product->price, 2) }}</p>
                            
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 flex items-center justify-center">
                                    Move to Cart
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-pink-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="text-2xl font-medium text-gray-700 mb-2">Your wishlist is empty</h3>
                <p class="text-gray-500 mb-6">Browse our lovely bears and add some to your wishlist!</p>
                <a href="{{ route('products.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                    Explore Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection