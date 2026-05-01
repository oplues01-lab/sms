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
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">My Questions</h2>
            
            <div class="flex gap-3">
                <a href="<?php echo e(route('teacher.questions.create')); ?>" 
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Questions
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <!-- FILTER FORM -->
        <form method="GET" action="<?php echo e(route('teacher.questions.index')); ?>" class="mb-6">
            <div class="bg-gray-50 p-4 rounded border border-gray-200">
                <h3 class="font-semibold mb-3">Filter Questions</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Class</label>
                        <select name="class_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Classes</option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>" <?php echo e(request('class_id') == $class->id ? 'selected' : ''); ?>>
                                    <?php echo e($class->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Subject</label>
                        <select name="subject_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Subjects</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subject->id); ?>" <?php echo e(request('subject_id') == $subject->id ? 'selected' : ''); ?>>
                                    <?php echo e($subject->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Term</label>
                        <select name="term_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Terms</option>
                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($term->id); ?>" <?php echo e(request('term_id') == $term->id ? 'selected' : ''); ?>>
                                    <?php echo e($term->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Session</label>
                        <select name="academic_session_id" class="border p-2 w-full rounded text-sm">
                            <option value="">All Sessions</option>
                            <?php $__currentLoopData = $academic_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($session->id); ?>" <?php echo e(request('academic_session_id') == $session->id ? 'selected' : ''); ?>>
                                    <?php echo e($session->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Type</label>
                        <select name="type" class="border p-2 w-full rounded text-sm">
                            <option value="">All Types</option>
                            <option value="assessment" <?php echo e(request('type') == 'assessment' ? 'selected' : ''); ?>>Assessment</option>
                            <option value="exam" <?php echo e(request('type') == 'exam' ? 'selected' : ''); ?>>Exam</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                        Apply Filters
                    </button>
                    <a href="<?php echo e(route('teacher.questions.index')); ?>" class="bg-gray-400 text-white px-4 py-2 rounded text-sm hover:bg-gray-500">
                        Clear Filters
                    </a>
                </div>
            </div>
        </form>

        <!-- EXPORT BUTTONS (only show if there are questions) -->
        <?php if($questions->count() > 0): ?>
        <div class="flex gap-3 mb-4">
            <a href="<?php echo e(route('teacher.questions.pdf')); ?>?<?php echo e(http_build_query(request()->except('page'))); ?>" 
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                Export PDF
            </a>
            <a href="<?php echo e(route('teacher.questions.csv')); ?>?<?php echo e(http_build_query(request()->except('page'))); ?>" 
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
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        <?php echo e($questions->firstItem() + $index); ?>

                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <?php echo e(Str::limit($q->question, 80)); ?>

                    </td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo e($q->subject->name); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo e($q->class->name); ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo e($q->term->name); ?></td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded <?php echo e($q->type == 'exam' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'); ?>">
                            <?php echo e(ucfirst($q->type)); ?>

                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center"><?php echo e($q->marks); ?></td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="<?php echo e(route('teacher.questions.edit', $q->id)); ?>" 
                           class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                            Edit
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($questions->links()); ?>

        </div>
        <?php else: ?>
        <p class="text-gray-600 text-center py-8">
            No questions found with the selected filters. 
            <a href="<?php echo e(route('teacher.questions.create')); ?>" class="text-blue-600 hover:underline">Create your first question</a>.
        </p>
        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\teacher\questions\index.blade.php ENDPATH**/ ?>