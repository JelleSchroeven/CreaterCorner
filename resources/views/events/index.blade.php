<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 3000)"
                        x-show="show" 
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
                    >
                        {{ session('success') }}
                    </div>
                @endif

                @if($events->isEmpty())
                    <p>No events found.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($events as $event)
                            <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition">
                                <h3 class="text-lg font-semibold mb-2">{{ $event->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    Datum: {{ $event->start_date }} - {{ $event->end_date }}
                                </p>
                                <p class="text-sm text-gray-500 mb-2">
                                    Locatie: {{ $event->location }}
                                <p class="text-gray-700">{{ $event->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>