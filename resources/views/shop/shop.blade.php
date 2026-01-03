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
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div> 
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

            <!-- EVENTS -->
            <div class="mb-6 p-4 bg-white rounded shadow">
                <h3 class="font-bold text-lg mb-4">Deze shop gaat naar volgende events:</h3>

                @if($shop->events->isEmpty())
                    <p class="text-gray-600">Deze shop gaat nog naar geen events.</p>
                @else
                    <div class="relative">
                        <!-- Left Arrow -->
                        <button id="scrollLeftBtn"
                            onclick="scrollLeftEvent()"
                            class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-700 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full w-10 h-10 z-20 flex items-center justify-center hidden">
                            &larr;
                        </button>

                        <!-- Events Container -->
                        <div id="eventsContainer" class="flex space-x-4 overflow-x-hidden scroll-smooth px-2">
                            @foreach($shop->events as $event)
                                <div class="flex-shrink-0 w-1/3 md:w-1/3 lg:w-1/3 bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="text-lg font-semibold mb-2">{{ $event->name }}</h3>
                                    <p class="text-sm text-gray-500 mb-2">
                                        Datum: {{ \Carbon\Carbon::parse($event->start_date)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d-m-Y') }}
                                    </p>
                                    <p class="text-sm text-gray-500 mb-2">Locatie: {{ $event->location }}</p>
                                    <p class="text-gray-700">{{ $event->description }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Right Arrow -->
                        <button id="scrollRightBtn"
                            onclick="scrollRightEvent()"
                            class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-700 bg-opacity-50 hover:bg-opacity-80 text-white rounded-full w-10 h-10 z-20 flex items-center justify-center hidden">
                            &rarr;
                        </button>
                    </div>
                @endif
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
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                    @empty
                    <p>Geen producten beschikbaar.</p>
                @endforelse
            </div>

            </div>
            

        </div>
    </div>

    <script>
    const container = document.getElementById('eventsContainer');
    const btnLeft = document.getElementById('scrollLeftBtn');
    const btnRight = document.getElementById('scrollRightBtn');

    function getScrollAmount(){
        return container.clientWidth / 3;   
    }

    function scrollLeftEvent() {
        const scrollAmount = getScrollAmount();
        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        console.log('naar links gescrolled')
    }

    function scrollRightEvent() {
        const scrollAmount = getScrollAmount();
        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        console.log('naar rechts gescrolled')
    }

    function updateArrows() {
        const scrollLeftPos = Math.ceil(container.scrollLeft); // ceil voorkomt float issues
        const maxScroll = container.scrollWidth - container.clientWidth;

        btnLeft.style.display = scrollLeftPos > 0 ? 'flex' : 'none';
        btnRight.style.display = scrollLeftPos < maxScroll ? 'flex' : 'none';
    }

    updateArrows();

    container.addEventListener('scroll', updateArrows);
    window.addEventListener('resize', updateArrows);
    </script>
</x-app-layout>
