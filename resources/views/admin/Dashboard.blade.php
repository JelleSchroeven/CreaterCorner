<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Metrics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 font-semibold">Users</h3>
                    <p class="text-2xl font-bold">{{ $userCount }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 font-semibold">Shops</h3>
                    <p class="text-2xl font-bold">{{ $shopCount }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 font-semibold">Events</h3>
                    <p class="text-2xl font-bold">{{ $eventCount }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 font-semibold">Contact Messages</h3>
                    <p class="text-2xl font-bold">{{ $contactCount }}</p>
                </div>
            </div>

            {{-- Functionaliteiten Buttons --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('admin.faq.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow text-center">Manage FAQ</a>
                <a href="{{ route('admin.userManagement.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow text-center">Manage Users</a>
                <a href="{{ route('admin.events.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded shadow text-center">Manage Events</a>
            </div>

        </div>
    </div>
</x-app-layout>
    