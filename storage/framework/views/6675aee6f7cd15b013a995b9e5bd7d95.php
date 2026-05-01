






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
            <?php echo e(__('Terms')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
        <?php endif; ?>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Terms List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Code</th>
                                                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Created At</th>

                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($loop->iteration); ?></td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($term->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($term->code); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($term->created_at); ?></td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-gray-700 transition" href="<?php echo e(route('terms.edit', $term->id)); ?>">Edit</a>
                                        <?php if($term->status): ?>
                                        <form class="inline-block"  action="<?php echo e(route('terms.deactivate', $term->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this term?')">
                                            <?php echo csrf_field(); ?> 
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">
                                                Deactivate
                                        </button>
                                        </form>

                                        <?php else: ?> 
                                         <form class="inline-block" action="<?php echo e(route('terms.activate', $term->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to activate this term?')">
                                            <?php echo csrf_field(); ?> 

                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-gray-700 transition">
                                                Activate
                                            </button>
                                        </form>



                                       <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if($terms->isEmpty()): ?>
                    <p class="text-center py-6 text-gray-500">No class found.</p>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\terms\index.blade.php ENDPATH**/ ?>