










                <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role & Permission Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif


       






            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Create Role -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Create Role') }}</h3>
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="role_name" :value="__('Role Name')" />
                            <x-text-input id="role_name" class="block mt-1 w-full" type="text" name="role_name" :value="old('role_name')" required autofocus autocomplete="role_name" placeholder="Role Name" />
                            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Create Role') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Create Permission -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Create Permission') }}</h3>
                    <form action="{{ route('permissions.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="permission_name" :value="__('Permission Name')" />
                            <x-text-input id="permission_name" class="block mt-1 w-full" type="text" name="permission_name" :value="old('permission_name')" required autofocus autocomplete="permission_name" placeholder="Permission Name" />
                            <x-input-error :messages="$errors->get('permission_name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Create Permission') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Assign Permission -->

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">{{ __('Assign Permissions to Role') }}</h3>
            <form action="{{ route('permissions.assign') }}" method="POST">
                @csrf
                <div>
            <x-input-label for="role_id_assign" :value="__('Select Role')" />
            <select name="role_id" id="role_id_assign"
                class="form-control w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>        
        
        </div>
        <div class="mt-4">
            <x-input-label for="permission_ids_assign" :value="__('Select Permissions (hold CTRL or CMD to select multiple)')" />
            <select name="permission_ids[]" id="permission_ids_assign" multiple size="8"
                class="form-control w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

         <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Assign Selected Permissions') }}
            </x-primary-button>
        </div>
    </form>
</div>

<!-- Revoke Permissions -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">{{ __('Revoke Permissions from Role') }}</h3>
    <form action="{{ route('permissions.revoke') }}" method="POST">
        @csrf
        <div>
            <x-input-label for="role_id_revoke" :value="__('Select Role')" />
            <select name="role_id" id="role_id_revoke"
                class="form-control w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="permission_ids_revoke" :value="__('Select Permissions to Revoke (hold CTRL or CMD to select multiple)')" />
            <select name="permission_ids[]" id="permission_ids_revoke" multiple size="8"
                class="form-control w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4 bg-red-600 hover:bg-red-700">
                {{ __('Revoke Selected Permissions') }}
            </x-primary-button>
        </div>
    </form>
</div>




                
            </div>
        </div>
    </div>
</x-app-layout>

           