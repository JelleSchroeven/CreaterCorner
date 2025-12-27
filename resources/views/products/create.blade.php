<x-app-layout>
    <x-slot name="header">
        <h2>Create Product</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label>Description</label>
                <textarea name="description" class="w-full border p-2 rounded">{{ old('description') }}</textarea>
            </div>
            <div class="mb-4">
                <label>Price (€)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label>Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label>Image</label>
                <input type="file" name="image_path" class="w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded">Add Product</button>
        </form>
    </div>
</x-app-layout>
