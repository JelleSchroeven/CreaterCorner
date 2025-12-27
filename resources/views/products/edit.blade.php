<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
                        <textarea name="description" id="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="price">Price (€)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- Current Image -->
                    @if($product->image_path)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Current Image</label>
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-40 w-full object-cover rounded">
                        </div>
                    @endif

                    <!-- Upload New Image -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="image_path">Upload New Image</label>
                        <input type="file" name="image_path" id="image_path" class="w-full border rounded px-3 py-2">
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Product
                    </button>
                </form>
                @auth
                    @if(auth()->id() === $product->user_id)
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-2 inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">
                                Delete
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
