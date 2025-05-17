@extends('layouts.admin')

@section('content')
    <h2>Manage Messages</h2>
    <a href="{{ route('admin.messages.create') }}" class="btn btn-primary mb-3">Add New Message</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->id }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject }}</td>
                    <td>
                        <a href="{{ route('admin.messages.edit', $msg->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
