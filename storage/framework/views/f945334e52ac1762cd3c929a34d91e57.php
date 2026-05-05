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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Profile
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10">
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">

            <!-- ACTIONS -->
            <div class="flex justify-end gap-3 mb-6">
                <a href="<?php echo e(route('students.edit', $student->id)); ?>"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    Edit
                </a>

                <?php if($student->status === 0): ?>
                    <form method="POST" action="<?php echo e(route('students.deactivate', $student->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="bg-red-600 text-white px-4 py-2 rounded">
                            Activate
                        </button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('students.activate', $student->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="bg-red-600 text-white px-4 py-2 rounded">
                            Deactivate
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <!-- PROFILE -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-2">
                    <p><strong>Name:</strong> <?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></p>
                    <p><strong>Admission No:</strong> <?php echo e($student->admission_no); ?></p>
                    <p><strong>Class:</strong> <?php echo e($student->classes->name ?? 'N/A'); ?></p>
                    <p><strong>Arm:</strong> <?php echo e($student->class_arm->name ?? 'N/A'); ?></p>
                    <p><strong>Session:</strong> <?php echo e($student->academicsessions->name ?? 'N/A'); ?></p>
                    <p><strong>Status:</strong>
                        <span class="px-2 py-1 rounded text-white
                            <?php echo e($student->status === 1 ? 'bg-green-600' : 'bg-red-600'); ?>">
                            Active
                        </span>
                    </p>
                </div>

                <div class="flex justify-center">
                    <img src="<?php echo e(asset('storage/students/'.$student->photo)); ?>"
                         class="w-40 h-40 rounded-full border">
                </div>
            </div>

            <!-- ID CARD -->
            <div class="mt-8">
                <h3 class="text-lg font-bold mb-4">Student ID Card</h3>

                <a href="<?php echo e(route('students.idcard', $student->id)); ?>"
                   class="inline-block border rounded-lg p-6 hover:shadow-lg transition">
                    <p class="font-semibold">View ID Card</p>
                    <p class="text-sm text-gray-500">Front & Back</p>
                </a>
            </div>

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
<?php endif; ?>
<?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/students/detail.blade.php ENDPATH**/ ?>