<x-app-layout>
    <x-slot name="header">
        <!-- Geen header, of leeg -->
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Shop Banner als achtergrond -->
            <div class="w-full h-48 rounded-lg mb-6 bg-gray-200 relative overflow-hidden">
                @if(!empty($shop->banner_image))
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $shop->banner_image) }}');"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div> <!-- donker overlay voor contrast -->
                @endif

                <!-- Shop Name -->
                <div class="absolute bottom-4 left-4 text-white text-2xl font-bold z-10">
                    {{ $shop->name ?? 'Shop' }}
                </div>
                <!-- Edit Shop knop als eigenaar -->
                @auth
                    @if(auth()->id() === $shop->user_id)
                        <a href="{{ route('shop.edit', $shop->slug) }}" class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded z-10">
                            Edit Shop
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Shop Description -->
            <div class="mb-6 p-4 bg-white rounded shadow">
                <p class="text-gray-700">{{ $shop->description ?? 'Geen beschrijving beschikbaar.' }}</p>
            </div>

            <!-- Producten Grid -->
            <div class="mb-6 p-4 bg-white rounded shadow">
                <div>
                    <h3 class="font-bold" >Products</h3>
                </div>
                @auth
                    @if(auth()->id() === $shop->user_id)
                        <a href="{{ route('products.my') }}" 
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                            Edit Products
                        </a>
                    @endif
                @endauth

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($shop->products as $product)
                    <div class="bg-white shadow rounded-lg p-4 flex flex-col h-96">
                        <!-- Product afbeelding -->
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-40 w-full object-cover mb-4 rounded">
                        @endif

                        <!-- Product naam -->
                        <h3 class="font-bold text-lg mb-2 truncate">{{ $product->name }}</h3>

                        <!-- Beschrijving -->
                        <p class="text-gray-600 mb-2 flex-1">{{ $product->description }}</p>

                        <!-- Prijs -->
                        <span class="font-semibold mb-2">€{{ number_format($product->price, 2) }}</span>

                        <!-- Add to cart knop -->
                        <button class="mt-auto bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Add to Cart
                        </button>
                    </div>
                    @empty
                    <p>Geen producten beschikbaar.</p>
                @endforelse
            </div>

            </div>
            

        </div>
    </div>
</x-app-layout>
