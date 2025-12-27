<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Contact</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Naam</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
                @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
                @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block font-medium">Onderwerp</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full border rounded px-3 py-2">
                @error('subject')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block font-medium">Bericht</label>
                <textarea name="message" rows="5" class="w-full border rounded px-3 py-2">{{ old('message') }}</textarea>
                @error('message')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                Verstuur
            </button>
        </form>
    </div>
</x-app-layout>
