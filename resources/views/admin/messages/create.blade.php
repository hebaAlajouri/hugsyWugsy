@extends('layouts.admin')

@section('content')
    <h2>Add New Message</h2>

    <form action="{{ route('admin.messages.store') }}" method="POST">
        @csrf

        <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
        <div class="mb-3"><label>Email</label><input name="email" class="form-control"></div>
        <div class="mb-3"><label>Subject</label><input name="subject" class="form-control"></div>
        <div class="mb-3"><label>Message</label><textarea name="message" class="form-control"></textarea></div>

        <button class="btn btn-success">Save</button>
    </form>
@endsection
