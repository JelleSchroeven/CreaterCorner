<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->following()->where('followed_id', $user->id)->exists()) {
            $authUser->following()->detach($user->id);
            $message = 'Stopped following ' . $user->name;
        } else {
            $authUser->following()->attach($user->id);
            $message = 'Now following ' . $user->name;
        }

        return redirect()->back()->with('success', $message);
    }
}

