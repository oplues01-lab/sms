










<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles & Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">

        {{ session('success') }}
    </div>
        @endif

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="mt-6">
    <h4 class="font-semibold mb-2">Permissions for Selected Role:</h4>
    <ul id="role-permissions-list" class="list-disc list-inside text-gray-700"></ul>
</div>
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Roles List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                          
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($roles as $role) 
                                <tr class="hover:bg-gray-50 transition-colors duration-150 role-row" data-role-id="{{ $role->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> {{ $loop->iteration }}</td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $role->name ?? 'N/A' }}</td>
                               
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <a href="" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            
                                        </a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($roles->isEmpty())
                    <p class="text-center py-6 text-gray-500">No role found.</p>
                @endif
            </div>
        </div>


        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Permission List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                           
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($permissions as $permission) 
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$loop->iteration}}</td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $permission->name ?? 'N/A' }}</td>
                               
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <a href="" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            
                                        </a> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($permissions->isEmpty())
                    <p class="text-center py-6 text-gray-500">No permissions found.</p>
                @endif
            </div>
        </div>




    


    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('.role-row').on('click', function() {
            var roleId = $(this).data('role-id');

            var list = $('#role-permissions-list');
            list.empty();
            $('.role-row').removeClass('bg-blue-100');
            $(this).addClass('bg-blue-100');


            if (roleId) {
                $.ajax({
                    url: `/roles/${roleId}/permissions`,
                    method: 'GET',
                    success: function(response) {
                        if (response.permissions.length > 0) {
                            response.permissions.forEach(function(permission) {
                                list.append(`<li>${permission}</li>`);
                            });
                        } else {
                            list.append('<li>No permissions assigned to this role.</li>');
                        }
                    },
                    error: function() {
                        list.append('<li>Error fetching permissions.</li>');
                    }
                });
            }
        });
    });
</script>
