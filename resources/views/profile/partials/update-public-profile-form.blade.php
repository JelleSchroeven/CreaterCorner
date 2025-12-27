<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Public Profile
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            This information is visible to everyone.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            @if(auth()->user()->profile_photo_path)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="mt-3 w-40 h-40 rounded-full object-cover">
            @endif
            <x-input-label for="profile_photo_path" value="Profile photo"/>
            <input type="file" name="profile_photo_path" class="mt-1 block w-full">
        </div>

        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                value="{{ old('username', auth()->user()->username) }}" required />
        </div>

        <div>
            <x-input-label for="bio" value="About me" />
            <textarea name="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', auth()->user()->bio) }}</textarea>
        </div>

        

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</section>
    