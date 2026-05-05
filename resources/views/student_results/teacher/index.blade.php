<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Student Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filter Form -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg shadow-sm border border-blue-100 mb-6">
                        <form id="">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                                    <select name="session_id" id="session_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Select Session</option>
                                        @foreach($academic_sessions as $session)
                                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Term</label>
                                    <select name="term_id" id="term_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Select Term</option>
                                        @foreach($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                                    <select name="class_id" id="class_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Class Arm</label>
                                    <select name="class_arm_id" id="class_arm_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Select Arm</option>
                                        @foreach($classarms as $arm)
                                            <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                    <select name="subject_id" id="subject_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <option value="">Select Subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              <div class="flex items-end">
 <div class="flex items-center justify-end mt-4">
           <x-primary-button type="button" id="loadResult">
    {{ __('Load Students') }}
</x-primary-button>

        </div>
  
    
</div>

                            </div>
                        </form>
                    </div>

                    <!-- Results Table -->
                        <div id="studentsTable" class="mt-6"></div>

                        <!-- <div class="text-center mt-6">
                            <button type="submit" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-medium py-3 px-8 rounded-md shadow-sm transition duration-150 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Save All Results
                            </button>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.getElementById('loadResult').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let class_id = document.getElementById('class_id').value;
    let class_arm_id = document.getElementById('class_arm_id').value;
    let session_id = document.getElementById('session_id').value;
    let term_id = document.getElementById('term_id').value;
    let subject_id = document.getElementById('subject_id').value;

    if(!class_id || !class_arm_id || !session_id || !term_id || !subject_id){
        alert('Please select all fields.');
        return;
    }

    fetch(`{{ route('student_results.getResults') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            class_id,
            class_arm_id,
            session_id,
            term_id,
            subject_id
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data)
        if (data.length === 0) {
            document.getElementById('studentsTable').innerHTML = `
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                    <p class="text-yellow-700 font-medium">No students found in this class arm.</p>
                </div>`;
            return;
        }

        let table = `
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">S/N</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Student ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">CA Score</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Exam Score</th>
                    
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b">Totas</th>

                        </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">`;

        data.forEach((result, index) => {
            table += `
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                         ${index +1}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <input type="hidden" name="student_id[]" value="${result.student ? result.student.admission_no : ''}">
                          ${result.student ? result.student.admission_no : ''}

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${result.student ? result.student.first_name + ' ' + result.student.last_name : ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${result.ca_score ?? ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${result.exam_score ?? ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${result.total ?? ''}</td>

                    </tr>`;
        });

        table += `</tbody>
            </table>
        </div>`;
        document.getElementById('studentsTable').innerHTML = table;
    });
});
</script>