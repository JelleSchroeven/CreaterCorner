<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow space-y-6">

            <!-- Profielfoto, username en bio -->
            <div class="flex items-center gap-6">
                <div>
                    @if($user->profile_photo_path)
                        <img src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/default-avatar.png') }}" class="mt-3 w-40 h-40 rounded-full object-cover">
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

        </div>
    </div>
</x-app-layout>
