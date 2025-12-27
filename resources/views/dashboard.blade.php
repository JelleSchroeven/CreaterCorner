<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Welkom bij CreaterCorner</h1>

        @auth
            <p>Hallo {{ auth()->user()->name }}, hier is jouw dashboard overzicht.</p>
            <!-- eventueel kort overzicht van shop, orders, etc -->
        @else
            <p>Bekijk onze shops en producten, of registreer je om een eigen shop te starten!</p>
        @endauth
    </div>
</x-app-layout>
        