@extends('layouts.app')

@section('title', 'My Lovely Wishlist')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 1140px; background-color: #fff0f5;">
        <h1 class="text-center text-danger fw-bold display-5 mb-1">My Lovely Wishlist</h1>
        <p class="text-center text-secondary mb-4">All your favorite cuddly friends in one place!</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(count($products) > 0)
            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm position-relative">
                            
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-danger fw-semibold">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="text-primary fw-bold fs-5">${{ number_format($product->price, 2) }}</p>

                                <form action="#" method="POST" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-danger w-100 d-flex justify-content-center align-items-center">
                                        Move to Cart
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ms-2" width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-5 bg-white rounded shadow">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#f8c4d6" class="mb-3" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="fw-semibold fs-4 text-muted mb-2">Your wishlist is empty</h3>
                <p class="text-secondary mb-4">Browse our lovely bears and add some to your wishlist!</p>
                <a href="#" class="btn btn-danger px-4">Explore Products</a>
            </div>
        @endif
    </div>
</div>
@endsection
