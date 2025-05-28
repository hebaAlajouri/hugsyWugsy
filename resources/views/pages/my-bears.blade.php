@extends('layouts.app2')
@section('title', 'My Bear Collection')
@section('content')
<div class="container mt-5">
    <h1>🐻 My Bear Collection</h1>
    <div class="row">
        @foreach($certificates as $cert)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $cert->bear_name }}</h5>
                        <p>Adopted: {{ $cert->formatted_adoption_date }}</p>
                        <a href="{{ route('pages.certificate.edit', $cert) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection