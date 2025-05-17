@extends('layouts.admin')

@section('content')
    <h2>Edit Certificate</h2>

    <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Owner Name</label>
            <input type="text" name="owner_name" class="form-control" value="{{ $certificate->owner_name }}">
        </div>

        <div class="mb-3">
            <label>Bear Name</label>
            <input type="text" name="bear_name" class="form-control" value="{{ $certificate->bear_name }}">
        </div>

        <div class="mb-3">
            <label>Adoption Date</label>
            <input type="date" name="adoption_date" class="form-control" value="{{ $certificate->adoption_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
