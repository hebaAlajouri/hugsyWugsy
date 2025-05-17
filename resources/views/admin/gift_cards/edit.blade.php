@extends('layouts.admin')

@section('content')
    <h2>Edit Gift Card #{{ $giftCard->id }}</h2>

    <form action="{{ route('admin.gift_cards.update', $giftCard->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Template Image</label>
            <input type="text" name="template" class="form-control" value="{{ $giftCard->template }}">
        </div>

        <div class="mb-3">
            <label>Recipient Name</label>
            <input type="text" name="recipient_name" class="form-control" value="{{ $giftCard->recipient_name }}">
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control">{{ $giftCard->message }}</textarea>
        </div>

        <div class="mb-3">
            <label>Sender Name</label>
            <input type="text" name="sender_name" class="form-control" value="{{ $giftCard->sender_name }}">
        </div>

        <div class="mb-3">
            <label>Font Style</label>
            <input type="text" name="font_style" class="form-control" value="{{ $giftCard->font_style }}">
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $giftCard->amount }}">
        </div>

        <div class="mb-3">
            <label>Delivery Method</label>
            <input type="text" name="delivery_method" class="form-control" value="{{ $giftCard->delivery_method }}">
        </div>

        <button type="submit" class="btn btn-hugsy">Update Gift Card</button>
    </form>
@endsection
