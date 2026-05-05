<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Staff') }}
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
                   <form action="{{ route('staff.store') }}" method="POST">
    @csrf
      
        
    <div>
 
    <select name="user_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option>Select User</option>
        @foreach(\App\Models\User::all() as $user)
        <option value="{{$user->id }}">{{$user->name}}</option>

        @endforeach
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />

        </select>
    </div>






<div class="mb-3">
        <label for="role" class="form-label">Assign Role</label>
        <select name="role" id="role" class="form-select" required>
            <option value="">-- Select Role --</option>
            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>



        <div>
            <x-input-label for="designation" :value="__('Designation')" />
            <x-text-input id="designation" class="block mt-1 w-full" type="text" name="designation" :value="old('designation')" required autofocus autocomplete="designation" />
            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
        </div>




      <div class="flex items-center justify-end mt-4">
      

            <x-primary-button class="ms-4">
                {{ __('Add Staff') }}
            </x-primary-button>
        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
