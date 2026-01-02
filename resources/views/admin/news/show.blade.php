<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    
    <div class="flex justify-center mt-4">
        <div class="w-full max-w-[80vw]">
            <div class="bg-white shadow rounded-lg p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold">{{ $news->title }}</h2>
                </div>
                
                @if($news->image)
                    <div>
                        <img src="{{ asset('storage/' . $news->image) }}" class="max-w-[450px] max-h-[300px] object-contain rounded">
                    </div>
                @endif

                <div>
                    <label class="block font-medium">Publicatiedatum</label>
                    <p>{{ $news->published_at->format('d-m-Y') }}</p>
                </div>

                <div>
                    <label class="block font-medium">Inhoud</label>
                    <div class="prose mt-2">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>

                <a class="text-blue-600 mt-2 inline-block" href="{{ route('admin.news.index') }}">
                    ← Terug naar overzicht
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
