<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function create() {
        return view('messages.create');
    }

    public function store(Request $request) {
        Message::create($request->all());
        return redirect()->route('messages.index');
    }

    public function edit(Message $message) {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message) {
        $message->update($request->all());
        return redirect()->route('messages.index');
    }

    public function destroy(Message $message) {
        $message->delete();
        return redirect()->route('messages.index');
    }
}
