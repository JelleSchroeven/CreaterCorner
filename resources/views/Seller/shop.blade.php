<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Shop
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($products->isEmpty())
                    <p>No products found.</p>
                @else
                    <ul>
                        @foreach($products as $product)
                            <li class="border p-4 rounded mb-4">
                                <strong>{{ $product->name }}</strong> - €{{ $product->price }}
                                <p>{{ $product->description }}</p>

                                @if(auth()->id() === $user->id && auth()->user()->role === 'seller')
                                    <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-blue-600 text-white px-3 py-1 rounded mt-2">Edit</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
