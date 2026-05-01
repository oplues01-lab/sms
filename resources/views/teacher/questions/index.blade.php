<x-app-layout>
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">My Questions</h2>
            
            <div class="flex gap-3">
                <a href="{{ route('teacher.questions.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Questions
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- FILTER FORM -->
        <form method="GET" action="{{ route('teacher.questions.index') }}" class="mb-6">
            <div class="bg-gray-50 p-4 rounded border border-gray-200">
                <h3 class="font-semibold mb-3">Filter Questions</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Class</label>
                        <select name="class_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Classes</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Subject</label>
                        <select name="subject_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Subjects</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Terms</option>
                            @foreach($terms as $term)
                                <option value="{{ $term->id }}" {{ request('term_id') == $term->id ? 'selected' : '' }}>
                                    {{ $term->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Session</label>
                        <select name="academic_session_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Sessions</option>
                            @foreach($academic_sessions as $session)
                                <option value="{{ $session->id }}" {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Type</label>
                        <select name="type" class="border p-2 w-full rounded text-sm">
                            <option value="">All Types</option>
                            <option value="assessment" {{ request('type') == 'assessment' ? 'selected' : '' }}>Assessment</option>
                            <option value="exam" {{ request('type') == 'exam' ? 'selected' : '' }}>Exam</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                        Apply Filters
                    </button>
                    <a href="{{ route('teacher.questions.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded text-sm hover:bg-gray-500">
                        Clear Filters
                    </a>
                </div>
            </div>
        </form>

        <!-- EXPORT BUTTONS (only show if there are questions) -->
        @if($questions->count() > 0)
        <div class="flex gap-3 mb-4">
            <a href="{{ route('teacher.questions.pdf') }}?{{ http_build_query(request()->except('page')) }}" 
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                Export PDF
            </a>
            <a href="{{ route('teacher.questions.csv') }}?{{ http_build_query(request()->except('page')) }}" 
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                Export CSV
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Question</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Subject</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Class</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Term</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Marks</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($questions as $index => $q)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $questions->firstItem() + $index }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ Str::limit($q->question, 80) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $q->subject->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $q->class->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $q->term->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded {{ $q->type == 'exam' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($q->type) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $q->marks }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="{{ route('teacher.questions.edit', $q->id) }}" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $questions->links() }}
        </div>
        @else
        <p class="text-gray-600 text-center py-8">
            No questions found with the selected filters. 
            <a href="{{ route('teacher.questions.create') }}" class="text-blue-600 hover:underline">Create your first question</a>.
        </p>
        @endif
    </div>
</div>
</x-app-layout>