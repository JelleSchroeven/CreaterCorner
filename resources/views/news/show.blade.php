<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $news->title }}</h2>
    </x-slot>

    <div class="space-y-4">
        <img class="max-w-xl"
             src="{{ asset('storage/' . $news->image) }}">

        <p class="text-sm text-gray-500">
            {{ $news->published_at->format('d-m-Y') }}
        </p>

        <div class="prose">
            {!! nl2br(e($news->content)) !!}
        </div>

        <a class="text-blue-600" href="{{ route('news.index') }}">
            ← Terug naar overzicht
        </a>
    </div>
</x-app-layout>
