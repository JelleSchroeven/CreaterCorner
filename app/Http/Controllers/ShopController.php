<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    // Toon formulier om shop aan te maken
    public function create()
    {
        return view('shop.create');
    }

    // Shop opslaan
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        $shop = new Shop();
        $shop->user_id = auth()->id();
        $shop->name = $request->name;
        $shop->slug = Str::slug($request->name);
        $shop->description = $request->description;

        if ($request->hasFile('banner_image')) {
            $shop->banner_image = $request->file('banner_image')->store('shops', 'public');
        }

        $shop->save();

        return redirect()->route('seller.shop', $shop->slug)->with('success', 'Shop succesvol aangemaakt!');
    }

    // Bewerk shop
    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop); // enkel eigenaar kan
        return view('shop.edit', compact('shop'));
    }

    // Update shop
    public function update(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|max:2048',
        ]);

        $shop->name = $request->name;
        $shop->slug = Str::slug($request->name);
        $shop->description = $request->description;

        if ($request->hasFile('banner_image')) {
            $shop->banner_image = $request->file('banner_image')->store('shops', 'public');
        }

        $shop->save();

        return redirect()->route('seller.shop', $shop->slug)->with('success', 'Shop bijgewerkt!');
    }

    public function show($slug)
    {
        $shop = \App\Models\Shop::where('slug', $slug)->firstOrFail();
        $user = $shop->user;
        $products = $shop->products ?? collect();

        return view('shop.shop', compact('user', 'shop', 'products'));
    }
}
