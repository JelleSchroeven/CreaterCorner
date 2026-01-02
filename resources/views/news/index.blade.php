<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuws</h2>
    </x-slot>

    <div class="space-y-6">
        @foreach($news as $item)
            <div class="p-4 bg-white shadow rounded">
                <h3 class="text-lg font-bold">{{ $item->title }}</h3>

                <img class="mt-2 max-w-md"
                     src="{{ asset('storage/' . $item->image) }}">

                <p class="text-sm text-gray-500 mt-1">
                    {{ $item->published_at->format('d-m-Y') }}
                </p>

                <p class="mt-2">
                    {{ Str::limit($item->content, 150) }}
                </p>

                <a class="text-blue-600 mt-2 inline-block"
                   href="{{ route('news.show', $item) }}">
                    Lees meer
                </a>
            </div>
        @endforeach

        {{ $news->links() }}
    </div>
</x-app-layout>
