<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Excel Student Upload') }}
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
                   <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
        <div>
    
            <select name="class_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option>Select class</option>
            @foreach(\App\Models\Classes::all() as $clas)
            <option value="{{$clas->id }}">{{$clas->name}}</option>

            @endforeach
                        <x-input-error :messages="$errors->get('classes')" class="mt-2" />

            </select>
        </div>

        <div>
            <select name="class_arm_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option>Select Class Arm</option>
            @foreach(\App\Models\Class_arm::all() as $classarm)
            <option value="{{$classarm->id }}">{{$classarm->name}}</option>

            @endforeach
                        <x-input-error :messages="$errors->get('claasarm')" class="mt-2" />

            </select>
        </div>

        <div>
            <select name="term_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option>Select Term</option>
            @foreach(\App\Models\Term::all() as $term)
            <option value="{{$term->id }}">{{$term->name}}</option>

            @endforeach
                        <x-input-error :messages="$errors->get('term')" class="mt-2" />

            </select>
        </div>

        <div>
            <select name="academic_sessions_id" class="form-control w-full mt-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option>Select Session</option>
            @foreach(\App\Models\AcademicSession::all() as $session)
            <option value="{{$session->id }}">{{$session->name}}</option>

            @endforeach
                        <x-input-error :messages="$errors->get('academic_sessions')" class="mt-2" />

            </select>
        </div>
        <div class="mb-4">
            <label for="file">Excel File</label>
            <input type="file" name="file" id="file" class="block w-full border rounded p-2 mt-2" required>
            <p class="text-sm text-gray-500 mt-1">Only .xlsx, .xls, or .csv allowed</p>
        </div>

      <div class="flex items-center justify-end mt-4">
      

        <x-primary-button>Upload Students</x-primary-button>

        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
