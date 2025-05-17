@extends('layouts.app')

@section('title', 'Thank You for Your Order!')

@section('content')
<div class="container py-5 text-center" style="background-color: #fff0f5; border-radius: 20px;">
    <h1 class="display-4 mb-3" style="color: #d63384; font-weight: bold;">🎉 Thank You for Your Order!</h1>
    <p class="lead mb-4" style="color: #c71585;">Your HugsyWugsy bear is being prepared with lots of love and fluff! 🧸💖</p>

    <div class="card shadow-sm mb-4" style="border-radius: 20px; border: none;">
        <div class="card-header text-white" style="background-color: #ff69b4; border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <h5 class="mb-0">💌 Order Summary</h5>
        </div>
        <div class="card-body" style="background-color: #fffafc; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
            @if($order && $order->items->count())
                <ul class="list-group text-start">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="border: none; background-color: #ffe4e1;">
                            <strong style="color: #d63384;">{{ $item->product->name }}</strong>
                            <span style="color: #c71585;">{{ $item->quantity }} × ${{ number_format($item->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-3 text-end">
                    <h5 style="color: #c71585;">Total: ${{ number_format($order->total, 2) }}</h5>
                </div>
            @else
                <p style="color: #d63384;">No items found in this order.</p>
            @endif
        </div>
    </div>

    <a href="{{ route('pages.certificate') }}" class="btn btn-lg mb-3" style="border: 2px dashed #ff69b4; color: #d63384; background-color: #fffafc; border-radius: 30px; padding: 10px 25px;">
        📄 Download Bear Adoption Certificate
    </a>
</div>
@endsection
