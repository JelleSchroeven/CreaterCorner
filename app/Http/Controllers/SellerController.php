<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function show($username)
    {
        $user = \App\Models\User::where('name', $username)->firstOrFail();

        $products= $user->products;

        return view('seller.shop', compact('user', 'products'));   
    }
}
