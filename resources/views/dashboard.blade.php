<x-app-layout>
    <x-slot name="header">
        Welcome to CreaterCorner
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- About Us sectie -->
        <div class="mt-12 bg-white p-6 rounded shadow max-w-xl mx-auto text-center">
            <h2 class="text-2xl font-semibold mb-4">Over CreaterCorner</h2>
            <p class="text-gray-700 text-lg">
                CreaterCorner is een platform voor creators en liefhebbers van unieke producten en evenementen. 
                Hier kan je shops ontdekken, nieuws volgen en deelnemen aan onze community.
            </p>
        </div>

        <!-- Shops Carousel Sectie -->
        <div class="mt-12 bg-gray-50 p-6 rounded">
            <h2 class="text-2xl font-semibold mb-4 text-center">Ontdek onze Shops</h2>

            <div x-data="{scroll: 0, scrollAmount: 220,maxScroll() { return $refs.container.scrollWidth - $refs.container.clientWidth }}" class="relative">
                <!-- Left Arrow -->
                <button @click="$refs.container.scrollLeft = Math.max(0, $refs.container.scrollLeft - scrollAmount)"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded shadow z-10">
                    &#8592;
                </button>

                <!-- Right Arrow -->
                <button @click="$refs.container.scrollLeft = Math.min($refs.container.scrollLeft + scrollAmount, $refs.container.scrollWidth - $refs.container.clientWidth)"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded shadow z-10">
                    &#8594;
                </button>
                
                <div x-ref="container" class="flex space-x-4 overflow-x-hidden scroll-smooth">
                    @foreach($shops as $shop)
                        <div class="min-w-[200px] bg-white rounded shadow p-4 flex-shrink-0">
                            <h3 class="text-lg font-bold mb-2">{{ $shop->name }}</h3>
                            @if($shop->banner_image)
                                <img src="{{ asset('storage/' . $shop->banner_image) }}" 
                                    alt="{{ $shop->name }}" 
                                    class="w-full h-32 object-cover rounded mb-2">
                            @else
                                <div class="w-full h-32 bg-gray-200 rounded mb-2 flex items-center justify-center text-gray-500">
                                    Geen afbeelding
                                </div>
                            @endif
                            <a href="{{ route('shop.show', $shop->slug) }}" class="text-blue-600 inline-block mt-2">Bekijk shop</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Nieuwssectie -->
        <div class="mt-12 bg-white p-6">
            <h2 class="text-2xl font-semibold mb-4 text-center">Laatste nieuws</h2>

            @if($news->count())
                <ul class="space-y-4">
                    @foreach($news as $item)
                        <li class="bg-gray-100 shadow rounded p-4">
                            <h3 class="text-lg font-bold">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->published_at->format('d-m-Y') }}</p>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="mt-2 max-w-xs max-h-48 object-contain rounded">
                            @endif
                            <p class="mt-2">{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                            <a href="{{ route('news.show', $item) }}" class="text-blue-600 mt-2 inline-block">Lees meer</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Er zijn momenteel geen nieuwsitems beschikbaar.</p>
            @endif
        </div>
    </div>
</x-app-layout>
