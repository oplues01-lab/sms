<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Photo</th>
                <th class="border px-4 py-2 text-left">Name</th>
                <th class="border px-4 py-2 text-left">Admission No</th>
                <th class="border px-4 py-2 text-left">Class</th>
                <th class="border px-4 py-2 text-left">Arm</th>
                <th class="border px-4 py-2 text-left">Status</th>
                <th class="border px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2">
                    <?php if($student->photo): ?>
                        <img src="<?php echo e(Storage::url('students/' . $student->photo)); ?>" 
                             class="w-12 h-12 rounded-full object-cover border"
                             alt="<?php echo e($student->full_name); ?>">
                    <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center border">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </td>
                <td class="border px-4 py-2"><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></td>
                <td class="border px-4 py-2"><?php echo e($student->admission_no); ?></td>
                <td class="border px-4 py-2"><?php echo e($student->classes->name ?? 'N/A'); ?></td>
                <td class="border px-4 py-2"><?php echo e($student->class_arm->name ?? 'N/A'); ?></td>
                <td class="border px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs text-white
                        <?php echo e($student->status === 1 ? 'bg-green-600' : 'bg-red-600'); ?>">
                        <?php echo e($student->status === 1 ? 'Active' : 'Inactive'); ?>

                    </span>
                </td>
                <td class="border px-4 py-2 text-center">
                    <a href="<?php echo e(route('students.detail', $student->id)); ?>" 
                       class="text-blue-600 hover:underline text-sm">View</a>
                    <span class="text-gray-300">|</span>
                    <a href="<?php echo e(route('students.photo', $student->id)); ?>" 
                       class="text-purple-600 hover:underline text-sm">Photo</a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="border px-4 py-8 text-center text-gray-500">
                    No students found
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($students->hasPages()): ?>
    <div class="mt-4">
        <?php echo e($students->links()); ?>

    </div>
    <?php endif; ?>
</div><?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/students/partials/student_table.blade.php ENDPATH**/ ?>