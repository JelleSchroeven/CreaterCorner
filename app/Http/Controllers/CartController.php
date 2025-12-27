<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $request->session()->get('cart', []);
        $itemsPerShop = [];

        foreach($cartItems as $key => $items) {
            $shopId = $items['shop_id'];
            $itemsPerShop[$shopId][$key] = $items;
            
        }

        $shops = [];
        $grandSubtotal = 0;

        foreach ($itemsPerShop as $shopId => $items) {
            $firstItem = reset($items);
            $shopName = $firstItem['shop_name'];
            $subtotal = array_sum(array_map(fn($i)=> $i['price'] * $i['quantity'], $items));
            $shops[$shopId] = [
                'name' => $shopName,
                'items' => $items,
                'subtotal' => $subtotal,
            ];
            $grandSubtotal += $subtotal;
        }

        $tax = $grandSubtotal * 0.21;
        $total = $grandSubtotal + $tax;

        return view('cart.index', compact('shops', 'grandSubtotal', 'tax', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        $id = $product->id;

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image_path' => $product->image_path,
                'shop_id' => $product->shop->id,
                'shop_name' => $product->shop->name, // <-- Voeg dit toe
                'quantity' => 1
            ];
        }

        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product toegevoegd aan je winkelmandje!');
    }

    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
        }
        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product verwijderd uit je winkelmandje.');
    }

    public function update(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, intval($request->quantity));
        }
        $request->session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Quantity bijgewerkt!');
    }

}
