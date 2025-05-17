@extends('layouts.admin')

@section('content')
    <h2>Manage Certificates</h2>

    <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary mb-3">Add New Certificate</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th><th>Owner</th><th>Bear</th><th>Adoption Date</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->id }}</td>
                    <td>{{ $certificate->owner_name }}</td>
                    <td>{{ $certificate->bear_name }}</td>
                    <td>{{ $certificate->adoption_date }}</td>
                    <td>
                        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
