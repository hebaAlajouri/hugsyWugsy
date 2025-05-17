@extends('layouts.admin')

@section('content')
<h2>Admin Wishlist</h2>
<a href="{{ route('admin.wishlist.create') }}" class="btn btn-hugsy mb-3">Add to Wishlist</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User</th>
            <th>Product</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wishlist as $item)
        <tr>
            <td>{{ $item->user->name ?? 'Unknown' }}</td>
            <td>{{ $item->product->name ?? 'Unknown' }}</td>
            <td>
                <a href="{{ route('admin.wishlist.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('admin.wishlist.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
