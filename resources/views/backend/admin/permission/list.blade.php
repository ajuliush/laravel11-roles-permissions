<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Permissions') }}
            </h2>
            <a href="{{ route('permission.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <form method="GET" action="{{ route('permission.index') }}">
                        <div class="flex items-center mb-4">
                            <input type="text" name="search" placeholder="Search permissions..." class="bg-gray-700 text-white px-4 py-2 rounded-md focus:outline-none focus:bg-gray-600" value="{{ request('search') }}">
                            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-md">Search</button>
                            <a href="{{ route('permission.index') }}" class="ml-3 bg-red-500 text-white px-4 py-2 rounded-md">Clear</a>
                        </div>
                    </form>
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-600 bg-gray-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-600 bg-gray-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-600 bg-gray-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    {{ $permission->id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="text-indigo-400 hover:text-indigo-200">Edit</a>
                                    <form action="{{ route('permission.destroy', $permission->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-200">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $permissions->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
