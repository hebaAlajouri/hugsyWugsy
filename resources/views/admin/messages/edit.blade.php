@extends('layouts.admin')

@section('content')
    <h2>Edit Message</h2>

    <form action="{{ route('admin.messages.update', $message->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3"><label>Name</label><input name="name" class="form-control" value="{{ $message->name }}"></div>
        <div class="mb-3"><label>Email</label><input name="email" class="form-control" value="{{ $message->email }}"></div>
        <div class="mb-3"><label>Subject</label><input name="subject" class="form-control" value="{{ $message->subject }}"></div>
        <div class="mb-3"><label>Message</label><textarea name="message" class="form-control">{{ $message->message }}</textarea></div>

        <button class="btn btn-success">Update</button>
    </form>
@endsection
