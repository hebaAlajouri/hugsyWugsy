@extends('layouts.admin')

@section('content')
    <h2>{{ isset($giftCard) ? 'Edit' : 'Create' }} Gift Card</h2>

    <form action="{{ isset($giftCard) ? route('admin.gift_cards.update', $giftCard) : route('admin.gift_cards.store') }}" method="POST">
        @csrf
        @if(isset($giftCard)) @method('PUT') @endif

        <div class="mb-3">
            <label>Recipient Name</label>
            <input type="text" name="recipient_name" class="form-control" value="{{ $giftCard->recipient_name ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Sender Name</label>
            <input type="text" name="sender_name" class="form-control" value="{{ $giftCard->sender_name ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control">{{ $giftCard->message ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $giftCard->amount ?? '' }}">
        </div>

        <div class="mb-3">
            <label>Delivery Method</label>
            <input type="text" name="delivery_method" class="form-control" value="{{ $giftCard->delivery_method ?? '' }}">
        </div>

        <button type="submit" class="btn btn-hugsy">{{ isset($giftCard) ? 'Update' : 'Save' }}</button>
    </form>
@endsection
