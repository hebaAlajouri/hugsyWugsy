@extends('layouts.admin')

@section('content')
    <h2>Manage Admin Roles</h2>
    <a href="{{ route('admin.admin_roles.create') }}" class="btn btn-primary mb-3">Add New Admin Role</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminRoles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->user->name ?? 'Deleted User' }}</td>
                    <td>{{ $role->role }}</td>
                    <td>
                        <a href="{{ route('admin.admin_roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.admin_roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
