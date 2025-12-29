<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div x-data="{ open: false, roleToAdd: 'user' }" class="grid grid-cols-1 md:grid-cols-4 gap-6">

                @php
                    $groups = [
                        'user' => 'Users',
                        'seller' => 'Sellers',
                        'moderator' => 'Moderators',
                        'admin' => 'Admins',
                    ];
                @endphp

                @foreach ($groups as $role => $label)
                    <div class="bg-white shadow rounded p-4">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-lg">{{ $label }}</h3>
                            <button 
                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm"
                                @click="open = true; roleToAdd = '{{ $role }}'"
                            >
                                Add
                            </button>
                        </div>

                        <div class="space-y-2">
                            @foreach ($users->where('role', $role) as $user)
                                <div class="border p-2 rounded flex justify-between items-center">
                                    <div>
                                        <div class="font-medium">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>

                                    <button class="text-sm text-blue-600 hover:underline">
                                        Edit
                                    </button>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach

                <!-- Modal -->
                <div x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center">
                    <!-- Overlay -->
                    <div class="fixed inset-0 bg-black/50 z-40" @click="open = false"></div>

                    <!-- Modal Box -->
                    <div class="bg-white w-full max-w-lg rounded-lg shadow p-6 z-50 relative">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add User</h3>
                            <button @click="open = false" class="text-gray-500 hover:text-black">✕</button>
                        </div>

                        <form method="POST" action="{{ route('admin.userManagement.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm">Name</label>
                                <input class="w-full border rounded p-2" type="text" name="name" required>
                            </div>

                            <div>
                                <label class="block text-sm">Email</label>
                                <input class="w-full border rounded p-2" type="email" name="email" required>
                            </div>

                            <div>
                                <label class="block text-sm">Role</label>
                                <select class="w-full border rounded p-2" name="role" x-model="roleToAdd" required>
                                    <option value="user">User</option>
                                    <option value="seller">Seller</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm">Password</label>
                                <input class="w-full border rounded p-2" type="password" name="password" required>
                            </div>
                    
                            <div>
                                <label class="block text-sm">Confirm Password</label>
                                <input class="w-full border rounded p-2" type="password" name="password_confirmation" required>
                            </div>

                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button" @click="open = false" class="px-4 py-2 bg-gray-200 rounded">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
