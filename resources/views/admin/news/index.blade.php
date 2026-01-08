<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Nieuws beheren</h2>
            <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Nieuw article
            </a>
        </div>
    </x-slot>
    <div class="flex justify-center mt-4">
        <div class="w-full max-w-[80%] overflow-x-auto">
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
                            <td class="p-3">{{ $item['title'] }}</td>
                            <td class="p-3 text-center">{{ \Carbon\Carbon::parse($item['published_at'])->format('d-m-Y') }}</td>
                            <td class="p-3 text-center space-x-2">
                                <a href="{{ url('/admin/news/' . $item['id']) }}" class="text-blue-600">Bekijk</a>
                                <a href="{{ url('/admin/news/' . $item['id'] . '/edit') }}" class="text-yellow-600">Bewerk</a>

                                <form class="inline" method="POST" action="{{ url('/admin/news/' . $item['id']) }}" 
                                    onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">Verwijder</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-center mt-6">
                <div class="inline-flex bg-white shadow rounded-lg overflow-hidden">
                    @for($i = 1; $i <= $lastPage; $i++)
                        <a href="{{ url('/admin/news?page=' . $i) }}"
                        class="px-4 py-2 border-r last:border-r-0
                                {{ $i == $currentPage ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
