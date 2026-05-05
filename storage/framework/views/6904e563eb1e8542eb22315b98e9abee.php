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
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Question</h2>

        <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('teacher.questions.update', $question->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Type *</label>
                <select name="type" class="border p-2 w-full rounded" required>
                    <option value="assessment" <?php echo e($question->type == 'assessment' ? 'selected' : ''); ?>>
                        Assessment
                    </option>
                    <option value="exam" <?php echo e($question->type == 'exam' ? 'selected' : ''); ?>>
                        Exam
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question Text *</label>
                <textarea name="question" rows="4" class="border p-2 w-full rounded" required><?php echo e(old('question', $question->question)); ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Option A</label>
                    <input type="text" name="option_a" value="<?php echo e(old('option_a', $question->option_a)); ?>" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option B</label>
                    <input type="text" name="option_b" value="<?php echo e(old('option_b', $question->option_b)); ?>" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option C</label>
                    <input type="text" name="option_c" value="<?php echo e(old('option_c', $question->option_c)); ?>" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Option D</label>
                    <input type="text" name="option_d" value="<?php echo e(old('option_d', $question->option_d)); ?>" class="border p-2 w-full rounded">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Correct Answer</label>
                    <select name="correct_option" class="border p-2 w-full rounded">
                        <option value="">Select Correct Option</option>
                        <option value="A" <?php echo e($question->correct_option == 'A' ? 'selected' : ''); ?>>A</option>
                        <option value="B" <?php echo e($question->correct_option == 'B' ? 'selected' : ''); ?>>B</option>
                        <option value="C" <?php echo e($question->correct_option == 'C' ? 'selected' : ''); ?>>C</option>
                        <option value="D" <?php echo e($question->correct_option == 'D' ? 'selected' : ''); ?>>D</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Marks *</label>
                    <input type="number" name="marks" value="<?php echo e(old('marks', $question->marks)); ?>" class="border p-2 w-full rounded" min="1" required>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Update Question
                </button>
                <a href="<?php echo e(route('teacher.questions.index')); ?>" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/teacher/questions/edit.blade.php ENDPATH**/ ?>