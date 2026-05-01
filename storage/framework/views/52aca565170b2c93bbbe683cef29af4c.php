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
            <?php echo e(__('Staff Details')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                     <p><strong>Status:</strong>
 
                        <span class="<?php echo e($staff->status ? 'text-green-600' : 'text-red-600'); ?> font-semibold">
                            <?php echo e($staff->status ? 'Active' : ' Inactive'); ?>

                        </span>

                    </p>

                    <h3 class="text-2xl font-bold mb-4"><?php echo e($staff->user->name ?? 'N/A'); ?></h3>

                    <div class="space-y-3">
                        <p><strong>Designation:</strong> <?php echo e($staff->designation ?? 'N/A'); ?></p>
                        <p><strong>Salary:</strong> ₦<?php echo e(number_format($staff->salary, 2) ?? 'N/A'); ?></p>
                        <p><strong>Role:</strong> <?php echo e($staff->user->role ?? 'N/A'); ?></p>
                        <p><strong>Email:</strong> <?php echo e($staff->user->email ?? 'N/A'); ?></p>
                    </div>

                    <div class="mt-6">
                        <a href="<?php echo e(route('staff.index')); ?>" 
                           class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                            Back
                        </a>

                              <a href="<?php echo e(route('staff.edit', $staff->id)); ?>" 
                           class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                            Edit
                            </a>

                        <?php if($staff->status): ?>
                        <form class="inline-block"  action="<?php echo e(route('staff.deactivate', $staff->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this staff?')">
                            <?php echo csrf_field(); ?> 
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                            Deactivate
                        </button>

                        </form>
                        <?php else: ?> 
                         <form class="inline-block"  action="<?php echo e(route('staff.activate', $staff->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to activate this staff?')">
                            <?php echo csrf_field(); ?> 
                            <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                            Activate
                        </button>

                        </form>


                        <?php endif; ?>
                    </div>
                </div>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\resources\views/staff/show.blade.php ENDPATH**/ ?>