<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
            @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error message -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Event Name')" />
                        <x-text-input id="name" name="name" type="text" value="{{ old('name', $event->name) }}" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" value="{{ old('location', $event->location) }}" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input id="start_date" name="start_date" type="date" value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="end_date" :value="__('End Date')" />
                        <x-text-input id="end_date" name="end_date" type="date" value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded">{{ old('description', $event->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class ="flex items-center justify-between ">
                        <x-primary-button>
                        {{ __('Update Event') }}
                        </x-primary-button>

                        <!-- Cancel Button -->
                        <a href="{{ route('events.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
                <br>
                <!-- delete button -->
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit">
                        {{ __('Delete Event') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
