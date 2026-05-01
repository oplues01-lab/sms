

<?php $__env->startSection('header'); ?>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Assignments
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="<?php echo e(route('students.assignments.index')); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
            ← Back to Assignments
        </a>
    </div>

    <!-- Assignment Details -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <div class="flex items-start justify-between mb-6">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800 mb-2"><?php echo e($assignment->title); ?></h1>
                
                <div class="flex flex-wrap gap-3 mb-4">
                    <?php if($submission): ?>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                            <?php echo e($submission->status === 'graded' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'); ?>">
                            <?php echo e(ucfirst($submission->status)); ?>

                        </span>
                    <?php elseif($assignment->isOverdue()): ?>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Overdue
                        </span>
                    <?php else: ?>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Open
                        </span>
                    <?php endif; ?>

                    <?php if($submission && $submission->isLate()): ?>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                            Late Submission
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-right">
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold text-lg">
                    <?php echo e($assignment->total_marks); ?> Marks
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Subject</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo e($assignment->subject->name); ?></p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-1">Teacher</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo e($assignment->teacher->name); ?></p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-1">Class</p>
                    <p class="text-lg font-semibold text-gray-800"><?php echo e($assignment->class->name); ?><?php echo e($assignment->classArm ? ' - ' . $assignment->classArm->name : ''); ?></p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-1">Due Date</p>
                    <p class="text-lg font-semibold <?php echo e($assignment->isOverdue() && !$submission ? 'text-red-600' : 'text-gray-800'); ?>">
                        <?php echo e($assignment->due_date->format('l, M d, Y h:i A')); ?>

                    </p>
                    <?php if(!$submission && !$assignment->isOverdue()): ?>
                        <p class="text-sm text-green-600 mt-1">
                            <?php echo e($assignment->due_date->diffForHumans()); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-3 text-lg">Assignment Description:</h3>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-700 whitespace-pre-line"><?php echo e($assignment->description); ?></p>
                </div>
            </div>

            <?php if($assignment->attachment): ?>
            <div class="mt-6">
                <h3 class="font-semibold text-gray-800 mb-3">Attachment:</h3>
                <a href="<?php echo e(Storage::url('assignments/' . $assignment->attachment)); ?>" 
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-3 rounded-lg hover:bg-blue-100 transition border border-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Download Assignment File</span>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Submission Section -->
    <?php if($submission && $submission->status === 'graded'): ?>
    <!-- Graded Submission -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-lg p-8 border-2 border-green-200">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Graded Submission</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg p-6 shadow text-center">
                <p class="text-sm text-gray-600 mb-2">Your Score</p>
                <p class="text-4xl font-bold text-green-600"><?php echo e($submission->marks_obtained); ?>/<?php echo e($assignment->total_marks); ?></p>
            </div>

            <div class="bg-white rounded-lg p-6 shadow text-center">
                <p class="text-sm text-gray-600 mb-2">Percentage</p>
                <p class="text-4xl font-bold text-blue-600"><?php echo e($submission->getPercentage()); ?>%</p>
            </div>

            <div class="bg-white rounded-lg p-6 shadow text-center">
                <p class="text-sm text-gray-600 mb-2">Grade</p>
                <p class="text-4xl font-bold text-purple-600"><?php echo e($submission->getGrade()); ?></p>
            </div>
        </div>

        <?php if($submission->teacher_feedback): ?>
        <div class="bg-white rounded-lg p-6 shadow">
            <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                Teacher's Feedback
            </h3>
            <p class="text-gray-700"><?php echo e($submission->teacher_feedback); ?></p>
        </div>
        <?php endif; ?>

        <div class="mt-6 bg-white rounded-lg p-6 shadow">
            <h3 class="font-semibold text-gray-800 mb-3">Your Submission:</h3>
            
            <?php if($submission->submission_text): ?>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Submission Text:</p>
                <p class="text-gray-700 bg-gray-50 p-3 rounded border border-gray-200"><?php echo e($submission->submission_text); ?></p>
            </div>
            <?php endif; ?>

            <?php if($submission->attachment): ?>
            <div>
                <p class="text-sm text-gray-600 mb-2">Attachment:</p>
                <a href="<?php echo e(Storage::url('submissions/' . $submission->attachment)); ?>" 
                   target="_blank"
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Your Submission
                </a>
            </div>
            <?php endif; ?>

            <p class="text-sm text-gray-600 mt-4">
                Submitted: <?php echo e($submission->submitted_at->format('M d, Y h:i A')); ?> | 
                Graded: <?php echo e($submission->graded_at->format('M d, Y h:i A')); ?>

            </p>
        </div>
    </div>

    <?php elseif($submission && $submission->status === 'submitted'): ?>
    <!-- Awaiting Grading -->
    <div class="bg-blue-50 rounded-lg shadow-lg p-8 border-2 border-blue-200">
        <div class="flex items-center gap-3 mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Awaiting Grading</h2>
        </div>

        <p class="text-gray-700 mb-6">Your assignment has been submitted successfully and is awaiting grading by your teacher.</p>

        <div class="bg-white rounded-lg p-6 shadow">
            <h3 class="font-semibold text-gray-800 mb-3">Your Submission:</h3>
            
            <?php if($submission->submission_text): ?>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Submission Text:</p>
                <p class="text-gray-700 bg-gray-50 p-3 rounded border border-gray-200"><?php echo e($submission->submission_text); ?></p>
            </div>
            <?php endif; ?>

            <?php if($submission->attachment): ?>
            <div>
                <p class="text-sm text-gray-600 mb-2">Attachment:</p>
                <a href="<?php echo e(Storage::url('submissions/' . $submission->attachment)); ?>" 
                   target="_blank"
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Your Submission
                </a>
            </div>
            <?php endif; ?>

            <p class="text-sm text-gray-600 mt-4">
                Submitted: <?php echo e($submission->submitted_at->format('M d, Y h:i A')); ?>

            </p>
        </div>
    </div>

    <?php else: ?>
    <!-- Submit Assignment Form -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        <?php if(session('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
            <p class="text-green-800 font-medium"><?php echo e(session('success')); ?></p>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
            <p class="text-red-800 font-medium"><?php echo e(session('error')); ?></p>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
            <ul class="list-disc list-inside text-red-700">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Submit Your Assignment</h2>

        <?php if($assignment->isOverdue()): ?>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
            <p class="text-yellow-800 font-medium">⚠️ This assignment is overdue. Your submission will be marked as late.</p>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('students.assignments.submit', $assignment)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Your Answer/Response</label>
                <textarea name="submission_text" rows="8" 
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                          placeholder="Type your answer here..."><?php echo e(old('submission_text')); ?></textarea>
                <p class="text-xs text-gray-500 mt-1">Or upload a file below</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload File (Optional)</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                <span>Upload a file</span>
                                <input type="file" name="attachment" class="sr-only" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, PNG up to 10MB</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-md">
                    Submit Assignment
                </button>
                <a href="<?php echo e(route('students.assignments.index')); ?>" 
                   class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    <?php endif; ?>
</div>

<script>
document.querySelector('input[type="file"]')?.addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
        const label = e.target.closest('.space-y-1').querySelector('span');
        label.textContent = fileName;
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.students.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\students\assignments\show.blade.php ENDPATH**/ ?>