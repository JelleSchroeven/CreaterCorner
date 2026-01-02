<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuw nieuwsitem</h2>
    </x-slot>

    <div class='flex justify-center mt-4'>
        <div class="max-w-[80vw] space-y-6">
            <form method="POST"
                action="{{ route('admin.news.store') }}"
                enctype="multipart/form-data"
                class="w-full bg-white shadow rounded-lg p-6 space-y-6">

                @csrf

                <div>
                    <label class="block font-medium mb-1" for='title'>Titel</label>
                    <input class="w-full border rounded p-2" id='title' type="text" name="title" value="{{ old('title') }}">
                </div>

                <div>
                    <label class="block font-medium mb-1" for='image'>Afbeelding</label>
                    <input id='image' type="file" name="image" class="block">
                </div>

                <div>
                    <label class="block font-medium mb-1" for='content'>Inhoud</label>
                    <textarea class="w-full border rounded p-2" id='content' name="content" rows="6">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label class="block font-medium mb-1" for='publication_date'>Publicatiedatum</label>
                    <input class="border rounded p-2" id='publication_date' type="date" name="published_at" value="{{ old('published_at') }}">
                </div>

                <button class="px-5 py-2 bg-blue-600 text-white rounded">
                    Opslaan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
