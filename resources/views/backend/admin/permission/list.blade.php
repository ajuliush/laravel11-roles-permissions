<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Permissions') }}
            </h2>
            @can('create permission')
            <a href="{{ route('permission.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">
                Create
            </a>
            @endcan
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
                            @if ($permissions->isNotEmpty())
                            @foreach ($permissions as $permission)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    @can('edit permission')
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                                    @endcan
                                    @can('delete permission')
                                    <a href="javascript:void(0);" onclick="deletePermission({{ $permission->id }})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="px-5 py-5 border-b border-gray-600 bg-gray-800 text-sm text-white">
                                    {{ "No Data available" }}
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $permissions->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id) {
                if (confirm("Are you sure want to delete?")) {
                    $.ajax({
                        url: '{{ route('permission.destroy') }}'
                        , type: 'delete'
                        , data: {
                            id: id
                        }
                        , dataType: 'json'
                        , headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        }
                        , success: function(response) {
                            window.location.href = '{{ route('permission.index') }}';
                        }
                    });
                }
            }

        </script>
    </x-slot>
</x-app-layout>
