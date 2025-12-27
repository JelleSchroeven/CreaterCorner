<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-6">

        <!-- Linker sectie: items per shop -->
        <div class="flex-1 bg-white p-6 rounded shadow space-y-6">
            @foreach($shops as $shop)
                <div class="border rounded p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $shop['name'] }}</h3>
                    <ul class="space-y-2">
                        @foreach($shop['items'] as $key => $item)
                            <li class="flex justify-between items-center gap-4">
                                <!-- Kleine productafbeelding -->
                                <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">

                                <!-- Productnaam en quantity -->
                                <div class="flex-1">
                                    <div class="font-semibold">{{ $item['name'] }}</div>
                                    <div>
                                        <form action="{{ route('cart.update', $key) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" onchange="this.form.submit()">
                                        </form>
                                    </div>
                                </div>

                                <!-- Totaalprijs per item -->
                                <div>€{{ number_format($item['price'] * $item['quantity'], 2) }}</div>

                                <!-- Verwijder knop -->
                                <form action="{{ route('cart.remove', $key) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold">×</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-right font-bold mt-2">Subtotal: €{{ number_format($shop['subtotal'], 2) }}</div>
                </div>
            @endforeach
        </div>

        <!-- Rechter sectie: totaal overzicht -->
        <div class="w-72 bg-white p-6 rounded shadow flex flex-col gap-4">
            @foreach($shops as $shop)
                <div class="flex justify-between">
                    <span>{{ $shop['name'] }}</span>
                    <span>€{{ number_format($shop['subtotal'], 2) }}</span>
                </div>
            @endforeach
            <hr>
            <div class="flex justify-between font-bold">
                <span>Subtotal:</span>
                <span>€{{ number_format($grandSubtotal, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold">
                <span>Tax (21%):</span>
                <span>€{{ number_format($tax, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold text-xl">
                <span>Total:</span>
                <span>€{{ number_format($total, 2) }}</span>
            </div>
        </div>

    </div>
</x-app-layout>
