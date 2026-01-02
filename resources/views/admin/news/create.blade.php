<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuw nieuwsitem</h2>
    </x-slot>

    <form method="POST"
          action="{{ route('admin.news.store') }}"
          enctype="multipart/form-data"
          class="space-y-6 max-w-xl">

        @csrf

        <div>
            <label class="block font-medium">Titel</label>
            <input class="w-full border rounded p-2" type="text" name="title" value="{{ old('title') }}">
        </div>

        <div>
            <label class="block font-medium">Afbeelding</label>
            <input type="file" name="image" class="block">
        </div>

        <div>
            <label class="block font-medium">Inhoud</label>
            <textarea class="w-full border rounded p-2" name="content" rows="6">{{ old('content') }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Publicatiedatum</label>
            <input class="border rounded p-2" type="date" name="published_at" value="{{ old('published_at') }}">
        </div>

        <button class="px-5 py-2 bg-blue-600 text-white rounded">
            Opslaan
        </button>
    </form>
</x-app-layout>
