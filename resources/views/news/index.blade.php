<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuws</h2>
    </x-slot>

    <div class="flex flex-col items-center mt-6 space-y-6">
        @foreach($news as $item)
            <div class="w-full max-w-[80%] bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold">{{ $item->title }}</h3>

                @if($item->image)
                    <img class="mt-4 max-w-full rounded"
                         src="{{ asset('storage/' . $item->image) }}"
                         alt="{{ $item->title }}">
                @endif

                <p class="text-sm text-gray-500 mt-2">
                    {{ $item->published_at->format('d-m-Y') }}
                </p>

                <p class="mt-4">
                    {{ Str::limit($item->content, 255) }}
                </p>

                <a class="text-blue-600 mt-4 inline-block"
                   href="{{ route('news.show', $item) }}">
                    Lees meer
                </a>
            </div>

            @if(!$loop->last)
                <div class="w-full max-w-[80%] border-t border-gray-300"></div>
            @endif
        @endforeach

        <div class="w-full max-w-[80%]">
            {{ $news->links() }}
        </div>
    </div>
</x-app-layout>
