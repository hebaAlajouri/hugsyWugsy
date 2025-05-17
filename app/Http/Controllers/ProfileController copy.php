<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(1);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('pages.profile', compact('user'));
    }

    public function edit()
    {
        $user = User::find(1);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('pages.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(1);

        if (!$user) {
            abort(404, 'User not found');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pages.profile.show')->with('success', 'Profile updated successfully!');
    }
}
