@extends('layouts.admin')

@section('content')
    <h2>Create Certificate</h2>

    <form action="{{ route('admin.certificates.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Bear Name</label>
            <input type="text" name="bear_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Adoption Date</label>
            <input type="date" name="adoption_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
