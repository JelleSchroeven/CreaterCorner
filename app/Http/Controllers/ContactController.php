<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.show');
    }

    public function send(Request $request)
    {
        // Validatie
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Mail sturen naar admin
        Mail::to(config('mail.admin_email'))->send(new ContactFormMail($validated));

        return back()->with('success', 'Bericht succesvol verzonden!');
    }
}

