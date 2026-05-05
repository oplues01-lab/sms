<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Master Results') }}
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
    console.log(1222233)
e.preventDefault();
    e.stopPropagation();

    let class_id = document.getElementById('class_id').value;
    let class_arm_id = document.getElementById('class_arm_id').value;
    let session_id = document.getElementById('session_id').value;
    let term_id = document.getElementById('term_id').value;
  

 if(!class_id || !class_arm_id || !session_id || !term_id ){
        alert('Please select all fields.');
        return;
    }

fetch(`{{ route('student_results.getMasterResults') }}`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
    },
    body: JSON.stringify({
        class_id,
        class_arm_id,
        session_id,
        term_id
    })
})
.then(res => res.json())
.then(data => {
    console.log(data);
    const subjects = data.subjects;
    const results = data.results;

    if (!results || results.length === 0) {
        document.getElementById('studentsTable').innerHTML = `
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <p class="text-yellow-700 font-medium">No student results found.</p>
            </div>`;
        return;
    }

    // Create dynamic header
    let table = `
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">S/N</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Admission No</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Student Name</th>`;

    subjects.forEach(sub => {
        table += `<th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">${sub}</th>`;
    });

    table += `
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Average</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Grade</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Position</th>
                      <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
    `;

    // Table body
    results.forEach((r, index) => {
        table += `
            <tr>
                <td class="px-4 py-2 text-sm">${index + 1}</td>
                <td class="px-4 py-2 text-sm">${r.admission_no}</td>
                <td class="px-4 py-2 text-sm">${r.student_name}</td>`;

        subjects.forEach(sub => {
            table += `<td class="px-4 py-2 text-sm text-center">${r.subjects[sub] ?? '-'}</td>`;
        });

        table += `
                <td class="px-4 py-2 text-sm font-semibold">${r.total}</td>
                <td class="px-4 py-2 text-sm">${r.average}</td>
                <td class="px-4 py-2 text-sm">${r.grade}</td>
                <td class="px-4 py-2 text-sm font-semibold">${r.position}</td>                
                <td class="px-4 py-2 text-sm font-semibold"> 
                <form method="GET" action="{{ route('student_results.reportcard') }}">
    <input type="hidden" name="admission_no" value="${r.admission_no}">
    <input type="hidden" name="class_id" value="${class_id}">
    <input type="hidden" name="class_arm_id" value="${class_arm_id}">
    <input type="hidden" name="term_id" value="${term_id}">
    <input type="hidden" name="session_id" value="${session_id}">
    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">View</button>
</form>
                </td>

            </tr>`;
    });

    table += `</tbody></table></div>`;
    document.getElementById('studentsTable').innerHTML = table;
});

});





</script>
