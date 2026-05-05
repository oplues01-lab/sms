<x-app-layout>
<div class="max-w-4xl mx-auto py-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Create Questions</h2>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('teacher.questions.store') }}" id="question-form">
        @csrf

        <!-- CLASS -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Class *</label>
            <select id="class_id" name="class_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- TERM -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Term *</label>
            <select id="term_id" name="term_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Term --</option>
                @foreach($terms as $term)
                    <option value="{{ $term->id }}" {{ old('term_id') == $term->id ? 'selected' : '' }}>
                        {{ $term->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SESSION -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Academic Session *</label>
            <select id="academic_session_id" name="academic_session_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Session --</option>
                @foreach($academic_sessions as $session)
                    <option value="{{ $session->id }}" {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>
                        {{ $session->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SUBJECT -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Subject *</label>
            <select id="subject_id" name="subject_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- QUESTION SECTION -->
        <div id="question-section" class="hidden">
            <!-- TYPE -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Type *</label>
                <select name="type" class="border p-2 w-full rounded" required>
                    <option value="assessment" {{ old('type') == 'assessment' ? 'selected' : '' }}>Assessment</option>
                    <option value="exam" {{ old('type') == 'exam' ? 'selected' : '' }}>Exam</option>
                </select>
            </div>

            <!-- QUESTIONS CONTAINER -->
            <div id="questions-container"></div>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-3 mt-6">
                <button type="button" id="add-question" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                    Add Another Question
                </button>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Save All Questions
                </button>

                <a href="{{ route('teacher.questions.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Cancel
                </a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const classSelect = document.getElementById('class_id');
    const termSelect = document.getElementById('term_id');
    const sessionSelect = document.getElementById('academic_session_id');
    const subjectSelect = document.getElementById('subject_id');
    const questionSection = document.getElementById('question-section');
    const questionsContainer = document.getElementById('questions-container');
    const addQuestionBtn = document.getElementById('add-question');

    let questionCount = 0;

    function checkAllSelected() {
        if (classSelect.value && termSelect.value && sessionSelect.value && subjectSelect.value) {
            questionSection.classList.remove('hidden');
            if (questionCount === 0) {
                addQuestion();
            }
        } else {
            questionSection.classList.add('hidden');
        }
    }

    [classSelect, termSelect, sessionSelect, subjectSelect].forEach(el => {
        el.addEventListener('change', checkAllSelected);
    });

    function addQuestion() {
        questionCount++;

        const div = document.createElement('div');
        div.className = "border border-gray-300 p-4 mb-4 rounded bg-gray-50";
        div.dataset.questionNumber = questionCount;

        div.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-lg">Question ${questionCount}</h3>
                ${questionCount > 1 ? `<button type="button" class="remove-question text-red-600 hover:text-red-800" data-question="${questionCount}">Remove</button>` : ''}
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Question Text *</label>
                <textarea name="questions[${questionCount}][question]" 
                    class="border p-2 w-full rounded" 
                    rows="3" 
                    placeholder="Enter question" 
                    required></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Option A</label>
                    <input name="questions[${questionCount}][option_a]" 
                        class="border p-2 w-full rounded" 
                        placeholder="Option A">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Option B</label>
                    <input name="questions[${questionCount}][option_b]" 
                        class="border p-2 w-full rounded" 
                        placeholder="Option B">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Option C</label>
                    <input name="questions[${questionCount}][option_c]" 
                        class="border p-2 w-full rounded" 
                        placeholder="Option C">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Option D</label>
                    <input name="questions[${questionCount}][option_d]" 
                        class="border p-2 w-full rounded" 
                        placeholder="Option D">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Correct Answer</label>
                    <select name="questions[${questionCount}][correct_option]" 
                        class="border p-2 w-full rounded">
                        <option value="">Select Correct Option</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Marks *</label>
                    <input type="number" 
                        name="questions[${questionCount}][marks]" 
                        class="border p-2 w-full rounded" 
                        placeholder="Marks" 
                        min="1" 
                        required>
                </div>
            </div>
        `;

        questionsContainer.appendChild(div);

        // Add remove button listener
        const removeBtn = div.querySelector('.remove-question');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                div.remove();
                renumberQuestions();
            });
        }
    }

    function renumberQuestions() {
        const questions = questionsContainer.querySelectorAll('[data-question-number]');
        questionCount = 0;
        questions.forEach((questionDiv, index) => {
            questionCount++;
            const newNumber = questionCount;
            questionDiv.dataset.questionNumber = newNumber;
            questionDiv.querySelector('h3').textContent = `Question ${newNumber}`;
            
            // Update all input names
            questionDiv.querySelectorAll('[name^="questions["]').forEach(input => {
                const fieldName = input.name.match(/\[([^\]]+)\]$/)[1];
                input.name = `questions[${newNumber}][${fieldName}]`;
            });
        });
    }

    addQuestionBtn.addEventListener('click', addQuestion);

    // Initialize on page load if old input exists
    checkAllSelected();
});
</script>
</x-app-layout>