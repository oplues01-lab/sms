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
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <a href="<?php echo e(route('teacher.assignments.index')); ?>" class="text-blue-600 hover:text-blue-800 font-medium mb-4 inline-block">
            ← Back to Assignments
        </a>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-3xl font-bold text-gray-800"><?php echo e($assignment->title); ?></h1>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full <?php echo e($assignment->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                            <?php echo e(ucfirst($assignment->status)); ?>

                        </span>
                    </div>
                    
                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-4">
                        <span>📚 <?php echo e($assignment->subject->name); ?></span>
                        <span>🏫 <?php echo e($assignment->class->name); ?><?php echo e($assignment->classArm ? ' - ' . $assignment->classArm->name : ''); ?></span>
                        <span>📅 Due: <?php echo e($assignment->due_date->format('M d, Y h:i A')); ?></span>
                        <span>📊 <?php echo e($assignment->total_marks); ?> marks</span>
                    </div>

                    <p class="text-gray-700"><?php echo e($assignment->description); ?></p>

                    <?php if($assignment->attachment): ?>
                    <div class="mt-4">
                        <a href="<?php echo e(Storage::url('assignments/' . $assignment->attachment)); ?>" 
                           target="_blank"
                           class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Attachment
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="flex gap-2">
                    <a href="<?php echo e(route('teacher.assignments.edit', $assignment)); ?>" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Edit
                    </a>
                    <form action="<?php echo e(route('teacher.assignments.destroy', $assignment)); ?>" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Students</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e($stats['total_students']); ?></p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Submitted</p>
                    <p class="text-3xl font-bold text-blue-600"><?php echo e($stats['submitted']); ?></p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Graded</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo e($stats['graded']); ?></p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo e($stats['pending']); ?></p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg shadow">
        <p class="text-green-800 font-medium"><?php echo e(session('success')); ?></p>
    </div>
    <?php endif; ?>

    <!-- Submissions List -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Student Submissions</h2>

        <?php if($submissions->count() > 0): ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <?php echo e($submission->student->first_name); ?> <?php echo e($submission->student->last_name); ?>

                        </h3>
                        <p class="text-sm text-gray-600"><?php echo e($submission->student->admission_no); ?></p>
                        
                        <div class="flex gap-4 mt-2 text-sm">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                <?php echo e($submission->status === 'graded' ? 'bg-green-100 text-green-800' : 
                                   ($submission->status === 'submitted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')); ?>">
                                <?php echo e(ucfirst($submission->status)); ?>

                            </span>
                            
                            <?php if($submission->submitted_at): ?>
                            <span class="text-gray-600">
                                Submitted: <?php echo e($submission->submitted_at->format('M d, Y h:i A')); ?>

                                <?php if($submission->isLate()): ?>
                                    <span class="text-red-600 font-semibold ml-2">(LATE)</span>
                                <?php endif; ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($submission->status === 'graded'): ?>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-green-600"><?php echo e($submission->marks_obtained); ?>/<?php echo e($assignment->total_marks); ?></p>
                        <p class="text-sm text-gray-600">Grade: <?php echo e($submission->getGrade()); ?> (<?php echo e($submission->getPercentage()); ?>%)</p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($submission->submission_text): ?>
                <div class="mb-4">
                    <h4 class="font-medium text-gray-700 mb-2">Submission Text:</h4>
                    <p class="text-gray-600 bg-gray-50 p-3 rounded"><?php echo e($submission->submission_text); ?></p>
                </div>
                <?php endif; ?>

                <?php if($submission->attachment): ?>
                <div class="mb-4">
                    <a href="<?php echo e(Storage::url('submissions/' . $submission->attachment)); ?>" 
                       target="_blank"
                       class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Attachment
                    </a>
                </div>
                <?php endif; ?>

                <?php if($submission->teacher_feedback): ?>
                <div class="mb-4">
                    <h4 class="font-medium text-gray-700 mb-2">Your Feedback:</h4>
                    <p class="text-gray-600 bg-blue-50 p-3 rounded border-l-4 border-blue-400"><?php echo e($submission->teacher_feedback); ?></p>
                </div>
                <?php endif; ?>

                <?php if($submission->status !== 'graded'): ?>
                <form action="<?php echo e(route('teacher.assignments.grade', $submission)); ?>" method="POST" class="mt-4 pt-4 border-t border-gray-200">
                    <?php echo csrf_field(); ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Marks Obtained *</label>
                            <input type="number" name="marks_obtained" 
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                   min="0" max="<?php echo e($assignment->total_marks); ?>" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Feedback (Optional)</label>
                            <textarea name="teacher_feedback" rows="2" 
                                      class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                      placeholder="Provide feedback to the student..."></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                            Submit Grade
                        </button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p class="text-gray-500">No submissions yet</p>
        </div>
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
<?php endif; ?><?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/teacher/assignments/show.blade.php ENDPATH**/ ?>