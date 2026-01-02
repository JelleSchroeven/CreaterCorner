<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuws bewerken</h2>
    </x-slot>

    <form method="POST"
          action="{{ route('admin.news.update', $news) }}"
          enctype="multipart/form-data"
          class="space-y-6 max-w-xl">

        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Titel</label>
            <input class="w-full border rounded p-2" type="text" name="title" value="{{ old('title', $news->title) }}">
        </div>

        <div>
            <label class="block font-medium">Huidige afbeelding</label>
            <img class="max-w-sm mb-2" src="{{ asset('storage/' . $news->image) }}">
        </div>

        <div>
            <label class="block font-medium">Nieuwe afbeelding</label>
            <input type="file" name="image" class="block">
        </div>

        <div>
            <label class="block font-medium">Inhoud</label>
            <textarea class="w-full border rounded p-2" name="content" rows="6">{{ old('content', $news->content) }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Publicatiedatum</label>
            <input class="border rounded p-2" type="date" name="published_at" value="{{ old('published_at', $news->published_at->format('Y-m-d')) }}">
        </div>

        <button class="px-5 py-2 bg-blue-600 text-white rounded">
            Bijwerken
        </button>
    </form>
</x-app-layout>
