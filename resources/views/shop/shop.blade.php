<x-app-layout>
    <x-slot name="header">
        <!-- Geen header, of leeg -->
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Shop Banner als achtergrond -->
            <div class="w-full h-48 rounded-lg mb-6 bg-gray-200 relative overflow-hidden">
                @if(!empty($shop->banner_image))
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $user->shop->banner_image) }}');"></div>
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div> <!-- donker overlay voor contrast -->
                @endif

                <!-- Shop Name -->
                <div class="absolute bottom-4 left-4 text-white text-2xl font-bold z-10">
                    {{ $shop->name ?? 'Shop' }}
                </div>
                <!-- Edit Shop knop als eigenaar -->
                @auth
                    @if(auth()->id() === $shop->user_id)
                        <a href="{{ route('shop.edit', $shop) }}" class="absolute top-4 right-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded z-10">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="border rounded p-3">{{ $product->name }}</div>
                @empty
                    <p class="text-sm text-gray-500">No products yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
