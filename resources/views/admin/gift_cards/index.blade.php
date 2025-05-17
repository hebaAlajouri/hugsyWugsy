@extends('layouts.admin')

@section('content')
    <h2>Gift Cards</h2>
    <a href="{{ route('admin.gift_cards.create') }}" class="btn btn-hugsy mb-3">Create New</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Recipient</th><th>Sender</th><th>Amount</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($giftCards as $card)
                <tr>
                    <td>{{ $card->id }}</td>
                    <td>{{ $card->recipient_name }}</td>
                    <td>{{ $card->sender_name }}</td>
                    <td>${{ $card->amount }}</td>
                    <td>
                        <a href="{{ route('admin.gift_cards.edit', $card->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.gift_cards.destroy', $card->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this gift card?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
