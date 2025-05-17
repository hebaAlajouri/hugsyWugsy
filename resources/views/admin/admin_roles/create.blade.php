@extends('layouts.admin')

@section('content')
    <h2>Add Admin Role</h2>

    <form action="{{ route('admin.admin_roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
