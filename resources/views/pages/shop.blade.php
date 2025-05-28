@extends('layouts.app3')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shop_styles.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* Existing pink button styles */
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

    /* RESPONSIVE PRODUCT GRID */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        padding: 0 15px;
        margin-bottom: 40px;
    }

    .product-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
    }
    .product-card img {
        width: 100%;
        height: auto;
        max-height: 180px;
        object-fit: contain;
        margin-bottom: 10px;
        border-radius: 6px;
    }
    .product-card h3 {
        font-size: 1.2rem;
        margin-bottom: 6px;
        min-height: 3em; /* consistent height */
    }
    .price {
        font-weight: 700;
        color: #ec407a;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    .product-card .btn-primary {
        width: 100%;
        margin-bottom: 10px;
        font-weight: 600;
    }
    .heart-icon {
        font-size: 1.8rem;
        margin-top: auto;
    }

    /* CUSTOMIZATION SECTION */
    .customization {
        padding: 20px 15px;
        background: #fff0f6;
        border-radius: 10px;
        text-align: center;
        margin: 40px 0;
    }
    .customization h2 {
        color: #ec407a;
        margin-bottom: 12px;
    }
    .customization p {
        max-width: 600px;
        margin: 0 auto 20px auto;
        font-size: 1.1rem;
        color: #444;
    }
    .cta-btn {
        background-color: #ec407a;
        color: white;
        padding: 12px 28px;
        font-size: 1.1rem;
        border-radius: 30px;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }
    .cta-btn:hover {
        background-color: #d81b60;
        color: white;
        text-decoration: none;
    }

    /* RESPONSIVE ADJUSTMENTS */
    @media (max-width: 768px) {
        .product-card img {
            max-height: 140px;
        }
        .product-card h3 {
            font-size: 1.1rem;
        }
        .price {
            font-size: 1rem;
        }
        .heart-icon {
            font-size: 1.5rem;
        }
    }
    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 15px;
            padding: 0 10px;
        }
        .product-card img {
            max-height: 120px;
        }
        .product-card h3 {
            font-size: 1rem;
        }
        .price {
            font-size: 0.95rem;
        }
        .btn-primary, .heart-icon {
            font-size: 1.2rem;
        }
        .cta-btn {
            padding: 10px 20px;
            font-size: 1rem;
        }
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

                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="heart-icon" title="Add to Wishlist">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
                
                @if($product->is_customizable)
                    <i class="fas fa-magic" title="Customizable" style="color: #ec407a; font-size: 1.3rem; margin-top: 5px;"></i>
                @endif
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

            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="heart-icon" title="Add to Wishlist">
                    <i class="fas fa-heart"></i>
                </button>
            </form>

            @if($product->is_customizable)
                <i class="fas fa-magic" title="Customizable" style="color: #ec407a; font-size: 1.3rem; margin-top: 5px;"></i>
            @endif
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
    <a href="{{ route('customizer') }}" class="cta-btn" style="text-decoration: none;">✨ Start Customizing Now</a>
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
