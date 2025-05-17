@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #fff0f5; border-radius: 15px;">
    <div class="row align-items-center">
        <div class="col-md-6 text-center mb-4">
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="img-fluid rounded shadow" 
                 style="max-width: 100%; height: auto; border: 4px solid #ffc0cb;">
        </div>

        <div class="col-md-6">
            <h1 class="mb-3" style="color: #d63384; font-weight: bold;">{{ $product->name }}</h1>
            <p class="text-muted mb-4" style="font-size: 1.1rem;">{{ $product->description }}</p>
            <p class="h4 mb-4" style="color: #ff69b4;"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

            {{-- Add to Order Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mb-4 p-4" style="background-color: #ffe4e1; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">

                <div class="mb-3">
                    <label for="quantity" class="form-label" style="color: #d63384;">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" required style="border: 2px solid #ffc0cb;">
                </div>

                <button type="submit" class="btn w-100" style="background-color: #ff69b4; color: white; border-radius: 25px;">
                    💖 Add to Order
                </button>
            </form>

            {{-- Customize Button --}}
            @if($product->is_customizable)
                <a href="{{ route('pages.customizer', ['product' => $product->id]) }}" 
                   class="btn w-100" 
                   style="background-color: #c084fc; color: white; border-radius: 25px;">
                    🎨 Customize This Bear
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
