<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Formulier om product aan te maken
    public function create()
    {
        return view('products.create');
    }

    // Opslaan van een nieuw product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->user_id = auth()->id();
        $product->shop_id = auth()->user()->shop->id;

        if ($request->hasFile('image_path')) {
            $product->image_path = $request->file('image_path')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.my', auth()->user()->shop->slug)
                         ->with('success', 'Product succesvol toegevoegd!');
    }

    public function editIndex()
    {
        $products = auth()->user()->shop->products ?? collect();
        return view('products.edit-index', compact('products'));
    }

    public function edit($id)
    {
        $product = auth()->user()->products()->findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = auth()->user()->products()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        if ($request->hasFile('image_path')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $product->image_path = $request->file('image_path')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.my')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        abort_if(auth()->id() !== $product->user_id, 403);
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        return redirect()->route('products.my')->with('success', 'Product succesvol verwijderd!');
    }
    


}
