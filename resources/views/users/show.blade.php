<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <!-- Hoofd witte container -->
        <div class="bg-white p-6 rounded shadow space-y-6">
            
            <!-- Profiel sectie -->
            <div class="flex items-center gap-6 bg-gray-100 p-4 rounded">
                <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('default-avatar.png') }}" class="w-24 h-24 rounded-full object-cover">
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->username }}</h1>
                    <p class="text-gray-700">{{ $user->bio ?? 'Geen bio toegevoegd.' }}</p>
                </div>
            </div>

            <!-- Nieuws sectie -->
            <div class="bg-gray-50 p-4 rounded">
                <h2 class="text-xl font-semibold mb-2">Nieuws van {{ $user->username }}</h2>
                @if($newsPosts->isEmpty())
                    <p class="text-gray-500">Geen nieuws geplaatst.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($newsPosts as $post)
                            <li class="p-2 bg-white rounded shadow-sm hover:bg-gray-100">
                                <a href="{{ route('news-posts.show', $post->id) }}" class="text-blue-600 hover:underline font-medium">
                                    {{ $post->title }}
                                </a>
                                <p class="text-gray-500 text-sm">{{ $post->created_at->format('d-m-Y') }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
