<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div class="max-w-4xl mx-auto py-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Create Questions</h2>

    <?php if($errors->any()): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('teacher.questions.store')); ?>" id="question-form">
        <?php echo csrf_field(); ?>

        <!-- CLASS -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Class *</label>
            <select id="class_id" name="class_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Class --</option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($class->id); ?>" <?php echo e(old('class_id') == $class->id ? 'selected' : ''); ?>>
                        <?php echo e($class->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- TERM -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Term *</label>
            <select id="term_id" name="term_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Term --</option>
                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($term->id); ?>" <?php echo e(old('term_id') == $term->id ? 'selected' : ''); ?>>
                        <?php echo e($term->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- SESSION -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Academic Session *</label>
            <select id="academic_session_id" name="academic_session_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Session --</option>
                <?php $__currentLoopData = $academic_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($session->id); ?>" <?php echo e(old('academic_session_id') == $session->id ? 'selected' : ''); ?>>
                        <?php echo e($session->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- SUBJECT -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Subject *</label>
            <select id="subject_id" name="subject_id" class="border p-2 w-full rounded" required>
                <option value="">-- Select Subject --</option>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subject->id); ?>" <?php echo e(old('subject_id') == $subject->id ? 'selected' : ''); ?>>
                        <?php echo e($subject->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- QUESTION SECTION -->
        <div id="question-section" class="hidden">
            <!-- TYPE -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Type *</label>
                <select name="type" class="border p-2 w-full rounded" required>
                    <option value="assessment" <?php echo e(old('type') == 'assessment' ? 'selected' : ''); ?>>Assessment</option>
                    <option value="exam" <?php echo e(old('type') == 'exam' ? 'selected' : ''); ?>>Exam</option>
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

                <a href="<?php echo e(route('teacher.questions.index')); ?>" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/teacher/questions/create.blade.php ENDPATH**/ ?>