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

        return redirect()->route('shop.show', $shop->slug)->with('success', 'Shop succesvol aangemaakt!');
    }

    // Bewerk shop
    public function edit($slug)
    {
        $shop = Shop::where('slug', $slug)->firstOrFail();
        abort_if(auth()->id() !== $shop->user_id, 403);
        return view('shop.edit', compact('shop'));
    }

    // Update shop
    public function update(Request $request, $slug)
    {
        $shop = Shop::where('slug',$slug)->firstOrFail();
        abort_if(auth()->id() !== $shop->user_id, 403);

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
        return redirect()->route('shop.show', $shop->slug)->with('success', 'Shop bijgewerkt!');
    }

    public function show($slug)
    {
        $shop = Shop::with('user', 'products')->where('slug', $slug)->firstOrFail();
        $products = $shop->products;
        return view('shop.shop', compact('shop','products'));
    }
}
