@extends('layouts.app')

@section('title', 'HugsyWugsy - Customizable Cuddle Bear')

@section('content')
<div class="container">
    <header>
        <h1>HugsyWugsy</h1>
    </header>
    <main>
        <section class="product">
            <img src="{{ asset('images/pink-bear.jpg') }}" alt="Customizable Cuddle Bear" class="main-image">
            <div class="product-info">
                <h2>Customizable Cuddle Bear</h2>
                <p class="rating"><i class="fas fa-star"></i> <span>4.5</span> (239 reviews)</p>
                <p class="price">$29.99</p>
                <p class="description">Make your new best friend! Our CuddleBear is made with the softest premium materials and tons of love. Each bear is handcrafted and can be fully customized to create your perfect companion.</p>
                
                <form>
                    <div class="color-selection">
                        <label>Choose Color:</label>
                        <div>
                            <input type="radio" id="pink" name="color" value="pink" checked>
                            <label for="pink" class="color pink"></label>
                            <input type="radio" id="blue" name="color" value="blue">
                            <label for="blue" class="color blue"></label>
                            <input type="radio" id="yellow" name="color" value="yellow">
                            <label for="yellow" class="color yellow"></label>
                        </div>
                    </div>
                    
                    <div class="accessories">
                        <label>Add Accessories:</label>
                        <div>
                            <input type="checkbox" id="bow-tie" name="accessories" value="bow-tie">
                            <label for="bow-tie">Bow Tie</label>
                            <input type="checkbox" id="heart" name="accessories" value="heart">
                            <label for="heart">Heart</label>
                            <input type="checkbox" id="crown" name="accessories" value="crown">
                            <label for="crown">Crown</label>
                        </div>
                    </div>

                    <label for="message">Add Personal Message:</label>
                    <input type="text" id="message" name="message" placeholder="Enter your message (max 20 characters)">
                    
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        </section>

        <section class="thumbnails">
            <img src="{{ asset('images/brown-bear.jpg') }}" alt="Brown Bear">
            <img src="{{ asset('images/blue-bear.jpg') }}" alt="Blue Bear">
            <img src="{{ asset('images/yellow-bear.jpg') }}" alt="Yellow Bear">
        </section>

        <section class="features">
            <div><i class="fas fa-heart"></i> Made with Love</div>
            <div><i class="fas fa-paint-brush"></i> Customizable</div>
            <div><i class="fas fa-gift"></i> Perfect for Gifts</div>
            <div><i class="fas fa-star"></i> Premium Quality</div>
        </section>

        <section class="reviews">
            <h3>Customer Reviews</h3>
            <div class="review">
                <img src="{{ asset('images/sara-avatar.jpg') }}" alt="Sara M.">
                <p><strong>Sara M.</strong><br>Perfect gift for my best friend! The customization options made it so special.</p>
            </div>
            <div class="review">
                <img src="{{ asset('images/emily-avatar.jpg') }}" alt="Emily B.">
                <p><strong>Emily B.</strong><br>My daughter absolutely loves her personalized teddy! The quality is amazing.</p>
            </div>
        </section>
    </main>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/details.css') }}">
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush

@push('scripts')
<script src="{{ asset('js/details.js') }}"></script>
@endpush
