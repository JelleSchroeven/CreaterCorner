<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alle Shops
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Witte achtergrond container -->
            <div class="bg-white p-6 rounded-lg shadow">

                <!-- Info kaartje bovenaan -->
                <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-sm text-center">
                    <h3 class="text-xl font-bold mb-1">All Creators</h3>
                    <p class="text-gray-600 text-sm">
                        Op deze pagina zie je allemaal members van onze community die hun zelfgemaakte producten verkopen.
                    </p>
                </div>

                <!-- Shops Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse($shops as $shop)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            @if($shop->banner_image)
                                <div class="h-32 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $shop->banner_image) }}');"></div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">{{ $shop->name }}</h3>
                                <p class="text-gray-600 mb-4">{{ $shop->description ?? 'Geen beschrijving beschikbaar' }}</p>
                                <a href="{{ route('shop.show', $shop->slug) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Ga naar Shop
                                </a>
                            </div>
                        </div>
                    @empty
                        <p>Geen shops beschikbaar.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
