<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuws bewerken</h2>
    </x-slot>

    <div class="flex justify-center mt-6">
        <div class="w-full max-w-[80vw] bg-white p-6 rounded shadow space-y-6">

            <form method="POST"
                  action="{{ route('admin.news.update', $news) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium mb-1">Titel</label>
                    <input class="w-full border rounded p-2" type="text" name="title" value="{{ old('title', $news->title) }}">
                </div>

                @if($news->image)
                    <div>
                        <label class="block font-medium mb-1">Huidige afbeelding</label>
                        <img class="max-w-sm mb-2 rounded" src="{{ asset('storage/' . $news->image) }}">
                    </div>
                @endif

                <div>
                    <label class="block font-medium mb-1">Nieuwe afbeelding</label>
                    <input type="file" name="image" class="block">
                </div>

                <div>
                    <label class="block font-medium mb-1">Inhoud</label>
                    <textarea class="w-full border rounded p-2" name="content" rows="6">{{ old('content', $news->content) }}</textarea>
                </div>

                <div>
                    <label class="block font-medium mb-1">Publicatiedatum</label>
                    <input class="border rounded p-2" type="date" name="published_at" value="{{ old('published_at', $news->published_at->format('Y-m-d')) }}">
                </div>

                <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Bijwerken
                </button>

            </form>
        </div>
    </div>
</x-app-layout>
