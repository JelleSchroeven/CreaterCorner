<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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