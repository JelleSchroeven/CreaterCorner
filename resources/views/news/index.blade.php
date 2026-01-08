<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nieuws</h2>
    </x-slot>

    <div class="flex flex-col items-center mt-6 space-y-6">
        @foreach($news as $item)
            <div class="w-full max-w-[80%] bg-white shadow rounded p-6">
                <h3 class="text-lg font-bold">{{ $item['title'] }}</h3>

                {{-- Alleen tonen als image bestaat --}}
                @if(!empty($item['image']))
                    <img src="{{ $item['image'] }}" class="max-w-[450px] max-h-[300px] object-contain rounded" alt="{{ $item['title'] }}">
                @endif

                <p class="text-sm text-gray-500 mt-2">
                    {{ \Carbon\Carbon::parse($item['created_at'])->format('d-m-Y') }}
                </p>

                <p class="mt-4">{{ \Illuminate\Support\Str::limit($item['content'], 255) }}</p>

                <a class="text-blue-600 mt-4 inline-block" href="/news/{{ $item['id'] }}">Lees meer</a>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-6">
        <div class="inline-flex bg-white shadow rounded-lg overflow-hidden">
            @for($i = 1; $i <= $lastPage; $i++)
                <a href="{{ url('/news?page=' . $i) }}"
                class="px-4 py-2 border-r last:border-r-0 
                        {{ $i == $currentPage ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $i }}
                </a>
            @endfor
        </div>
    </div>
</x-app-layout>
