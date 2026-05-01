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
        <form action="{{ route('subject_teachers.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label for="teacher_id" class="block text-gray-700 font-medium">Select Teacher:</label>
                <select name="teacher_id" id="teacher_id" class="w-full border-gray-300 rounded mt-2" required>
                    <option value="">-- Select Teacher --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

             <div class="mb-4">
                <label for="teacher_id" class="block text-gray-700 font-medium">Select Classs:</label>
                <select name="class_id" id="teacher_id" class="w-full border-gray-300 rounded mt-2" required>
                    <option value="">-- Select Classs --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>


             <div class="mb-4">
                <label for="teacher_id" class="block text-gray-700 font-medium">Select Classarm:</label>
                <select name="classarm_id" id="teacher_id" class="w-full border-gray-300 rounded mt-2" required>
                    <option value="">-- Select Classarm --</option>
                    @foreach($classarms as $classarm)
                        <option value="{{ $classarm->id }}">{{ $classarm->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Select Subjects:</label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($subjects as $subject)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="subject_ids[]" value="{{ $subject->id }}" class="rounded border-gray-300">
                            <span>{{ $subject->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

      

      <div class="flex items-center justify-end mt-4">
      

            <x-primary-button class="ms-4">
                {{ __('Allocate Subject') }}
            </x-primary-button>
        </div>
    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>