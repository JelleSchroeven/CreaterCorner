<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Event;
use App\Models\Contact;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'userCount' => User::count(),
            'shopCount' => Shop::count(),
            'eventCount' => Event::count(),
            'contactCount' => Contact::count(),
        ]);
    }
}