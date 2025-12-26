<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('events.create') }}" 
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded shadow mb-4">Nieuw Event</a>
                    @endif
                @endauth

                @if($events->isEmpty())
                    <p>No events found.</p>
                @else
                    <ul>
                        @foreach($events as $event)
                            <li>
                                <strong>{{ $event->name }}</strong> - {{ $event->start_date }} to {{ $event->end_date }}
                                <p>{{ $event->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>