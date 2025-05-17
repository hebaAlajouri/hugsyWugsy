@extends('layouts.app')

@section('title', 'My Wishlist')
@push('styles')
<style>
    .bg-pink {
    background-color: #f8bbd0 !important;
}
.btn-pink {
    background-color: #ec407a;
    color: #fff;
}
.btn-pink:hover {
    background-color: #d81b60;
}
</style>
@endpush

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold" style="color: #e91e63;">💖 My Wishlist</h2>

    @if($wishlistItems->count())
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 position-relative h-100" style="background-color: #fff0f6;">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top rounded-top-4" alt="{{ $item->product->name }}" style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title fw-semibold" style="color: #c2185b;">{{ $item->product->name }}</h5>
                            <p class="card-text fs-5" style="color: #880e4f;">${{ number_format($item->product->price, 2) }}</p>

                            @if($item->product->is_customizable)
                                <span class="badge rounded-pill bg-pink text-white mb-2">✨ Customizable</span>
                            @endif

                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3">❌ Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center mt-5">
            <img src="https://cdn-icons-png.flaticon.com/512/833/833472.png" alt="Empty Wishlist" style="width: 150px; opacity: 0.7;">
            <h4 class="mt-3 text-muted">Oops! Your wishlist is empty.</h4>
            <p class="text-muted">Tap the 💖 icon on a product to add it here!</p>
            <a href="{{ route('shop.index') }}" class="btn btn-pink btn-lg mt-2" style="background-color: #f06292; color: white;">✨ Start Shopping</a>
        </div>
    @endif
</div>
@endsection
