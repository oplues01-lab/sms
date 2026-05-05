
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">

                        {{ session('success') }}
                    </div>
                @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')
            
         
             <div>
    <select name="user_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">Select User</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" 
                {{ old('user_id', $staff->user_id) == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
</div>


               <div class="mb-3">
    <label for="role" class="form-label">Assign Role</label>
    <select name="role" id="role" class="form-select" required>
        <option value="">-- Select Role --</option>
        @foreach(\Spatie\Permission\Models\Role::all() as $role)
            <option 
                value="{{ $role->name }}" 
                {{ old('role', $staff->user?->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('role')" class="mt-2" />
</div>




        <div>
            <x-input-label for="designation" :value="__('Designation')" />
            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation" :value="old('designation', $staff->designation)" required autofocus autocomplete="designation" />
            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="salary" :value="__('Salary')" />
            <x-text-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary', $staff->salary)" required autofocus autocomplete="salary" />
            <x-input-error :messages="$errors->get('salary')" class="mt-2" />
        </div>



      <div class="flex items-center justify-end mt-4">
      

            <x-primary-button class="ms-4">
                {{ __('Update Staff') }}
            </x-primary-button>
        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>