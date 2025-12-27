<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Shop') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Success message -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Validation errors -->
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('shop.update', $shop) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Shop Name -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Shop Name')" />
                        <x-text-input id="name" name="name" type="text" value="{{ old('name', $shop->name) }}" class="block mt-1 w-full" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Shop Description -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 rounded" rows="4">{{ old('description', $shop->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Banner Image -->
                    <div class="mb-4">
                        <x-input-label for="banner_image" :value="__('Banner Image')" />
                        <input type="file" id="banner_image" name="banner_image" class="block mt-1 w-full" />
                        @if($shop->banner_image)
                            <img src="{{ asset('storage/' . $shop->banner_image) }}" alt="Current Banner" class="mt-2 h-32 w-full object-cover rounded">
                        @endif
                        <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <x-primary-button>
                            {{ __('Update Shop') }}
                        </x-primary-button>

                        <a href="{{ route('seller.shop', $shop) }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
