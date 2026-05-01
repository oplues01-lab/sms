<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
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
        
        <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $student->first_name)" required autofocus autocomplete="first_name" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $student->last_name)" required autofocus autocomplete="last_name" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $student->email)" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>


                    <!-- <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password', $student->password)" required autofocus autocomplete="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div> -->

                <div>
            
                    <select name="class_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option>Select class</option>
                    @foreach(\App\Models\Classes::all() as $clas)
                    <option value="{{$clas->id }}" {{ old('clas', $student->classes->name) === $clas->name ? 'selected' : ''  }}>{{$clas->name}}</option>
 
                    @endforeach
                                <x-input-error :messages="$errors->get('classes')" class="mt-2" />

                    </select>
                </div>

                <div>
                    <select name="class_arm_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option>Select Class Arm</option>
                    @foreach(\App\Models\Class_arm::all() as $classarm)
                    <option value="{{$classarm->id }}" {{ old('classarm', $student->class_arm->name) === $classarm->name ? 'selected':'' }}>{{$classarm->name}}</option>

                    @endforeach
                                <x-input-error :messages="$errors->get('claasarm')" class="mt-2" />

                    </select>
                </div>

                <div>
                    <select name="term_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option>Select Term</option>
                    @foreach(\App\Models\Term::all() as $term)
                    <option value="{{$term->id }}" {{ old('term', $student->term->name) === $term->name ? 'selected' : '' }}>{{$term->name}}</option>

                    @endforeach
                                <x-input-error :messages="$errors->get('term')" class="mt-2" />

                    </select>
                </div>

                <div>
                    <select name="academic_sessions_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option>Select Session</option>
                    @foreach(\App\Models\AcademicSession::all() as $session)
                    <option value="{{$session->id }}" {{ old('session', $student->academicsessions->name) === $session->name ? 'selected' : '' }}>{{$session->name}}</option>

                    @endforeach
                                <x-input-error :messages="$errors->get('academic_sessions')" class="mt-2" />

                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                

                        <x-primary-button class="ms-4">
                            {{ __('Update Student') }}
                        </x-primary-button>
                    </div>
             </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>