@extends('layouts.app3')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shop_styles.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
    }
    .btn-pink:hover {
        background-color: #d81b60;
        color: white;
    }
    .heart-icon {
    background: none;
    border: none;
    outline: none;
    color: #e91e63; /* Pink color */
    font-size: 1.6rem;
    cursor: pointer;
    transition: transform 0.2s ease, color 0.2s ease;
}

.heart-icon:hover {
    color: #f06292; /* Lighter pink on hover */
    transform: scale(1.2);
}

</style>
@endpush

@section('content')

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h1>Shop the Magic of HugsyWugsy</h1>
        <p>Find your perfect teddy bear, flowers, and chocolates to spread joy!</p>
        <a href="{{ route('customizer') }}" class="cta-btn" style="text-decoration: none;">✨ Start Customizing</a>

    </div>
</section>

<!-- CATEGORY FILTERS -->
@if($categories->count())
<section class="text-center my-4">
    <h4 style="color: #ec407a;">Filter by Category</h4>
    <div class="d-flex justify-content-center flex-wrap gap-2 mt-3">
        <a href="{{ route('shop.index') }}" class="btn btn-sm {{ is_null($category) ? 'btn-pink' : 'btn-outline-secondary' }}">All</a>
        @foreach($categories as $cat)
            <a href="{{ route('shop.index', ['category' => $cat]) }}"
               class="btn btn-sm {{ $category === $cat ? 'btn-pink' : 'btn-outline-secondary' }}">
                {{ ucfirst($cat) }}
            </a>
        @endforeach
    </div>
</section>
@endif

<!-- FEATURED PRODUCTS -->
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <h2 class="text-center my-4">Featured Products</h2>
    <section class="product-grid">
        @foreach($featuredProducts as $product)
            <div class="product-card">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="price">${{ number_format($product->price, 2) }}</p>

                <a href="{{ route('pages.products.show', $product->id) }}" class="btn btn-primary">Show Details</a>

                @if($product->is_customizable)
                    <p>Customizable</p>
                @endif

                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="heart-icon" title="Add to Wishlist">
        <i class="fas fa-heart"></i> <!-- Font Awesome Heart Icon -->
    </button>
                </form>
            </div>
        @endforeach
    </section>
@endif

<!-- ALL PRODUCTS -->
<h2 class="text-center my-4">All Products</h2>
<section class="product-grid">
    @forelse($products ?? [] as $product)
        <div class="product-card">
            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p class="price">${{ number_format($product->price, 2) }}</p>

            <a href="{{ route('pages.products.show', $product->id) }}" class="btn btn-primary">Show Details</a>

            @if($product->is_customizable)
                <p>Customizable</p>
            @endif

            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="heart-icon" title="Add to Wishlist">
        <i class="fas fa-heart"></i> <!-- Font Awesome Heart Icon -->
    </button>
            </form>
        </div>
    @empty
        <div class="text-center w-100">
            <p>No products available at the moment.</p>
        </div>
    @endforelse
</section>

<!-- CUSTOMIZATION SECTION -->
<section class="customization">
    <h2>Customize Your Teddy Bear</h2>
    <p>Choose colors, accessories, and special embroidery to make your teddy uniquely yours.</p>
    <a href="{{ route('customizer') }}" class="cta-btn"style="text-decoration: none;">✨ Start Customizing Now</a>
</section>

@endsection

@section('scripts')
<script>
    const priceRange = document.getElementById('price-range');
    const priceValue = document.getElementById('price-value');
    if (priceRange && priceValue) {
        priceRange.addEventListener('input', function() {
            priceValue.textContent = this.value;
        });
        priceValue.textContent = priceRange.value;
    }
</script>
@endsection
