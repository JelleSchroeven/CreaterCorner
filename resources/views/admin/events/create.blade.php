<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuw Event
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.events.store') }}">
                    @csrf

                    <!-- Event Naam -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Event Naam')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Locatie -->
                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Locatie')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ old('name') }}" required />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Start Datum -->
                    <div class="mb-4">
                        <x-input-label for="start_date" :value="__('Start Datum')" />
                        <x-text-input 
                            id="start_date" 
                            name="start_date" 
                            class="block mt-1 w-full" 
                            type="date" 
                            value="{{ old('start_date'), isset($event) ? $event->start_date->format('Y-m-d') : '' }}"
                            
                            required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <!-- Eind Datum -->
                    <div class="mb-4">
                        <x-input-label for="end_date" :value="__('Eind Datum')" />
                        <x-text-input 
                            id="end_date" 
                            name="end_date"
                            class="block mt-1 w-full" 
                            type="date" 
                            value="{{ old('end_date'), isset($event) ? $event->end_date->format('Y-m-d') : '' }}" 
                            required />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <!-- Beschrijving -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Beschrijving')" />
                        <textarea 
                            id="description" 
                            name="description"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" 
                            rows="4"
                            required >{{old('description')}}</textarea>
                            
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        {{ __('Event Aanmaken') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
