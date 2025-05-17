@extends('layouts.admin')

@section('content')
    <h2>Edit Admin Role</h2>

    <form action="{{ route('admin.admin_roles.update', $admin_role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $admin_role->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" value="{{ $admin_role->role }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
