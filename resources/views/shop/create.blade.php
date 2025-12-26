<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Shop') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700">Shop Name</label>
                        <input type="text" name="name" id="name" class="block w-full border-gray-300 rounded mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="block w-full border-gray-300 rounded mt-1"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="banner_image" class="block font-medium text-gray-700">Banner Image</label>
                        <input type="file" name="banner_image" id="banner_image" class="block w-full mt-1">
                    </div>

                    <x-primary-button>
                        Create Shop
                    </x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
