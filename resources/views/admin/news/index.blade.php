<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Nieuws beheren</h2>
            <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Nieuw article
            </a>
        </div>
    </x-slot>

    <div class="overflow-x-auto mt-4">
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="p-3 text-left">Titel</th>
                    <th class="p-3 text-center">Datum</th>
                    <th class="p-3 text-center">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $item->title }}</td>
                        <td class="p-3 text-center">
                            {{ $item->published_at->format('d-m-Y') }}
                        </td>
                        <td class="p-3 text-center space-x-2">
                            <a href="{{ route('admin.news.show', $item) }}" class="text-blue-600">Bekijk</a>
                            <a href="{{ route('admin.news.edit', $item) }}" class="text-yellow-600">Bewerk</a>

                            <form class="inline"
                                  method="POST"
                                  action="{{ route('admin.news.destroy', $item) }}"
                                  onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">
                                    Verwijder
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $news->links() }}
        </div>
    </div>
</x-app-layout>
