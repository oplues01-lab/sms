<x-app-layout>
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Question</h2>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('teacher.questions.update', $question->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Type *</label>
                <select name="type" class="border p-2 w-full rounded" required>
                    <option value="assessment" {{ $question->type == 'assessment' ? 'selected' : '' }}>
                        Assessment
                    </option>
                    <option value="exam" {{ $question->type == 'exam' ? 'selected' : '' }}>
                        Exam
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Text *</label>
                <textarea name="question" rows="4" class="border p-2 w-full rounded" required>{{ old('question', $question->question) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Option A</label>
                    <input type="text" name="option_a" value="{{ old('option_a', $question->option_a) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option B</label>
                    <input type="text" name="option_b" value="{{ old('option_b', $question->option_b) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option C</label>
                    <input type="text" name="option_c" value="{{ old('option_c', $question->option_c) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option D</label>
                    <input type="text" name="option_d" value="{{ old('option_d', $question->option_d) }}" class="border p-2 w-full rounded">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Correct Answer</label>
                    <select name="correct_option" class="border p-2 w-full rounded">
                        <option value="">Select Correct Option</option>
                        <option value="A" {{ $question->correct_option == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $question->correct_option == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $question->correct_option == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ $question->correct_option == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Marks *</label>
                    <input type="number" name="marks" value="{{ old('marks', $question->marks) }}" class="border p-2 w-full rounded" min="1" required>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Update Question
                </button>
                <a href="{{ route('teacher.questions.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>