<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('public-profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,' . $user->id,
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string|max:500',
            'profile_photo_path' => 'nullable|image|max:2048',
        ]);

        $user->username = $request->username;
        $user->birthday = $request->birthday;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_photo_path')) {

            if ($user->profile_photo_path) {
                \Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo_path')->store('avatars', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()
            ->route('users.show', $user->username)
            ->with('success', 'Profiel bijgewerkt!');
    }

}


