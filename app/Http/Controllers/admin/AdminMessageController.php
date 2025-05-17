<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.messages.create');
    }

    public function store(Request $request)
    {
        Message::create($request->all());
        return redirect()->route('admin.messages.index')->with('success', 'Message added successfully.');
    }

    public function edit(Message $message)
    {
        return view('admin.messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $message->update($request->all());
        return redirect()->route('admin.messages.index')->with('success', 'Message updated successfully.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }
}
