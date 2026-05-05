<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Student List</h2>

                    <!-- FILTER FORM -->
                    <form id="filterForm" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <input
                                type="text"
                                name="search"
                                placeholder="Search by name or admission no"
                                class="border rounded p-2"
                            />

                            <select name="class_id" class="border rounded p-2">
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>

                            <select name="class_arm_id" class="border rounded p-2">
                                <option value="">Select Class Arm</option>
                                @foreach($arms as $arm)
                                    <option value="{{ $arm->id }}">{{ $arm->name }}</option>
                                @endforeach
                            </select>

                            <select name="term_id" class="border rounded p-2">
                                <option value="">Select Term</option>
                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}">{{ $term->name }}</option>
                                @endforeach
                            </select>

                            <select name="academic_sessions_id" class="border rounded p-2">
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                                Search
                            </button>

                            <button type="button" id="clearBtn" class="bg-gray-500 text-white px-4 py-2 rounded">
                                Clear
                            </button>
                        </div>
                    </form>

                    <!-- STUDENT TABLE -->
                    <div id="studentTable">
                        @include('students.partials.student_table')
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    const filterForm = document.getElementById('filterForm');

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(filterForm);
        const queryString = new URLSearchParams(formData).toString();

        fetch("{{ route('students.index') }}?" + queryString, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('studentTable').innerHTML = html;
        })
        .catch(error => console.error(error));
    });

    document.getElementById('clearBtn').addEventListener('click', function(){
        filterForm.reset();
        filterForm.dispatchEvent(new Event('submit'));
    });
</script>
