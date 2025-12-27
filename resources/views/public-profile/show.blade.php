<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow space-y-6">

            <!-- Profielfoto, username en bio -->
            <div class="flex items-center gap-6">
                <div>
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="mt-3 w-40 h-40 rounded-full object-cover">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->username }}</h1>
                    <p class="text-gray-600">{{ $user->bio ?? 'Geen bio toegevoegd.' }}</p>
                    @if($user->birthday)
                        <p class="text-gray-500">🎂 {{ $user->birthday->format('d-m-Y') }}</p>
                    @endif
                </div>
            </div>

            <!-- Nieuws -->
            <div>
                <h2 class="text-xl font-semibold mb-2">Nieuws van {{ $user->username }}</h2>
                <ul class="space-y-1">
                    @forelse($newsPosts as $post)
                        <li>
                            <a href="{{ route('news-posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                                {{ $post->title }}
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-500">Geen nieuws beschikbaar.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>
