<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Your Products
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between mb-6">
            <!-- New Product knop -->
            <a href="{{ route('products.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                New Product
            </a>

            <!-- Cancel knop -->
            <a href="{{ route('shop.show', auth()->user()->shop->slug) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white shadow rounded-lg p-4 flex flex-col h-96">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-40 w-full object-cover mb-4 rounded">
                    @endif
                    <h3 class="font-bold text-lg mb-2 truncate">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-2 flex-1">{{ $product->description }}</p>
                    <span class="font-semibold mb-2">€{{ number_format($product->price, 2) }}</span>
                    
                    <a href="{{ route('products.edit', $product->id) }}" class="mt-auto bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded">
                        Edit
                    </a>
                </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
