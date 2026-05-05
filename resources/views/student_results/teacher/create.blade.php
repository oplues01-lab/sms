<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Record Student Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 border border-green-400 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
             @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('student_results.store') }}" method="POST">
                    @csrf

                  
                    <div class="mb-4">
                        <label class="block text-gray-700">Select Class</label>
                        <select name="class_id" class="w-full border-gray-300 rounded mt-2" required>
                            <option value="">-- Class --</option>
                            @foreach($allocations as $alloc)
                                <option value="{{ $alloc->classes->id }}"
                                    data-classes="{{ $alloc->classes->id }}">
                                    {{ $alloc->classes->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>

                        @enderror
               
                    </div>

                      <div class="mb-4">
                        <label class="block text-gray-700">Select Class Arm</label>
                        <select name="class_arm_id" class="w-full border-gray-300 rounded mt-2" required>
                            <option value="">-- Select Class Arm--</option>
                            @foreach($allocations as $alloc)
                                <option value="{{ $alloc->classarm->id }}"
                                   
                                    data-classarm="{{ $alloc->classarm->id }}">
                                     {{ $alloc->classarm->name }}
                                </option>
                            @endforeach
                        </select>
                         @error('class_arm_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>

                        @enderror
               
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700">Term</label>
                            <select name="term_id" class="w-full border-gray-300 rounded mt-2" required>
                                <option value="">-- Select Term --</option>
                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700">Session</label>
                            <select name="session_id" class="w-full border-gray-300 rounded mt-2" required>
                                <option value="">-- Select Session --</option>
                                @foreach($academic_sessions as $academic_session)
                                    <option value="{{ $academic_session->id }}">{{ $academic_session->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Select subject</label>
                        <select name="subject_id" class="w-full border-gray-300 rounded mt-2" required>
                            <option value="">-- Select Subject --</option>
                            @foreach($allocations as $alloc)
                                <option value="{{ $alloc->subject->id }}"
                                    data-subject="{{ $alloc->subject->id }}"
                                    data-subject="{{ $alloc->subject->id }}">
                                    {{ $alloc->subject->name }} 
                                </option>
                            @endforeach
                        </select>
                           @error('subject_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>

                        @enderror
                    </div>
                
                
                    <div class="mt-4">
                <label class="block text-gray-700">Select Student</label>
                <select name="student_id" class="w-full border-gray-300 rounded mt-2" required>
                    <option value="">-- Select Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">
                            {{ old('student_id') == $student->id ? 'selected' : '' }}
                            {{ $student->name }} ({{ $student->admission_no }})
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-gray-700">CA Score</label>
                            <input type="number" name="ca_score" min="0" max="40" class="w-full border-gray-300 rounded mt-2" required>
                      @error('ca_score')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>

                        @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700">Exam Score</label>
                            <input type="number" name="exam_score" min="0" max="60" class="w-full border-gray-300 rounded mt-2" required>
                         @error('exam_score')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>

                        @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Save Result
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>