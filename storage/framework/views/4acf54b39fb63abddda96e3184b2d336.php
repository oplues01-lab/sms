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
            <?php echo e(__('Classes')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <?php if(session('success')): ?>
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">

                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Staff List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Designation</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                                <th class="px-6 py-3 text-center">Photo</th>

                          
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($loop->iteration); ?></td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($staff->user->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($staff->designation); ?></td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="<?php echo e(route('staff.show', $staff->id )); ?>" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            View
                                        </a>
                                    </td>


                                    <td class="text-center">
                                <details class="inline-block">
                                    <summary class="cursor-pointer px-3 py-1 bg-blue-600 text-white rounded">
                                        ID Card
                                    </summary>
                                    <div class="border bg-white shadow rounded mt-1">
                                        <a href="<?php echo e(route('staff.id.card', [$staff->id, 'front'])); ?>"
                                        class="block px-4 py-2 hover:bg-gray-100">
                                            Front
                                        </a>
                                        <a href="<?php echo e(route('staff.id.card', [$staff->id, 'back'])); ?>"
                                        class="block px-4 py-2 hover:bg-gray-100">
                                            Back
                                        </a>
                                    </div>
                                </details>
                            </td>
<td class="px-6 py-4 text-center">
    <a href="<?php echo e(route('staff.photo.create', $staff->id)); ?>"
       class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
        Capture Photo
    </a>
</td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if($staffs->isEmpty()): ?>
                    <p class="text-center py-6 text-gray-500">No staff found.</p>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\resources\views/staff/index.blade.php ENDPATH**/ ?>