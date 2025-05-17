@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Customizations</h2>
    <a href="{{ route('admin.customizations.create') }}" class="btn btn-primary mb-3">Add Customization</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Color</th>
                <th>Accessories</th>
                <th>Instructions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customizations as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->accessories }}</td>
                    <td>{{ $item->special_instructions }}</td>
                    <td>
                        <a href="{{ route('admin.customizations.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.customizations.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this customization?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
