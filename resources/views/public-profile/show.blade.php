<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
            <p>{{ $user->bio ?? 'Geen bio toegevoegd.' }}</p>
            
            <h2 class="mt-6 text-xl font-semibold">Nieuws van {{ $user->name }}</h2>
            <ul class="space-y-2 mt-2">
                @foreach($newsPosts as $post)
                    <li>
                        <a href="{{ route('news-posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
