<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        // Hier kun je extra info ophalen zoals nieuws van deze gebruiker
        $newsPosts = $user->newsPosts()->latest()->get();

        return view('public-profile.show', compact('user', 'newsPosts'));
    }
}

