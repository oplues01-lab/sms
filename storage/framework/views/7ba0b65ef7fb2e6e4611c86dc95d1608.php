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
    <div class="max-w-4xl mx-auto py-10">

        <div class="flex justify-between mb-6">
            <a href="<?php echo e(route('students.idcard', $student->id)); ?>"
               class="bg-gray-600 text-white px-4 py-2 rounded">
                Back
            </a>

            <a href="<?php echo e(route('students.idcard.print', $student->id)); ?>"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Print
            </a>
        </div>

        <?php if($side === 'front'): ?>
            <!-- FRONT -->
            <div class="border rounded-lg p-6 shadow">
                <div class="flex items-center gap-4">
                    <img src="<?php echo e(asset('storage/students/'.$student->photo)); ?>"
                         class="w-28 h-28 rounded-full border">
                    <div>
                        <p class="font-bold text-lg">
                            <?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?>

                        </p>
                        <p>Reg No: <?php echo e($student->admission_no); ?></p>
                        <p>Class: <?php echo e($student->classes->name ?? 'N/A'); ?></p>
                        <p>Arm: <?php echo e($student->class_arm->name ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- BACK -->
            <div class="border rounded-lg p-6 shadow text-sm">
                <p><strong>Session:</strong> <?php echo e($student->academicsessions->name ?? 'N/A'); ?></p>
                <p><strong>Email:</strong> <?php echo e($student->email); ?></p>
                <p><strong>Phone:</strong> <?php echo e($student->phone ?? 'N/A'); ?></p>

                <div class="mt-4">
                    <p class="font-semibold">Emergency Contact</p>
                    <p><?php echo e($student->parent_name ?? 'N/A'); ?></p>
                    <p><?php echo e($student->parent_phone ?? 'N/A'); ?></p>
                </div>
            </div>
        <?php endif; ?>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\students\idcard\view.blade.php ENDPATH**/ ?>