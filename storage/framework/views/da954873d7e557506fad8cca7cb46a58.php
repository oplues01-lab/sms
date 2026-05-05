










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
            <?php echo e(__('Roles & Permission')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <?php if(session('success')): ?>
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">

        <?php echo e(session('success')); ?>

    </div>
        <?php endif; ?>

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="mt-6">
    <h4 class="font-semibold mb-2">Permissions for Selected Role:</h4>
    <ul id="role-permissions-list" class="list-disc list-inside text-gray-700"></ul>
</div>
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Roles List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                          
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr class="hover:bg-gray-50 transition-colors duration-150 role-row" data-role-id="<?php echo e($role->id); ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> <?php echo e($loop->iteration); ?></td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($role->name ?? 'N/A'); ?></td>
                               
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <a href="" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            
                                        </a> -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if($roles->isEmpty()): ?>
                    <p class="text-center py-6 text-gray-500">No role found.</p>
                <?php endif; ?>
            </div>
        </div>


        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Permission List</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">S/N</th>
                               <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Name</th>
                           
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($loop->iteration); ?></td>
                                  
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($permission->name ?? 'N/A'); ?></td>
                               
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- <a href="" 
                                           class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 transition">
                                            
                                        </a> -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php if($permissions->isEmpty()): ?>
                    <p class="text-center py-6 text-gray-500">No permissions found.</p>
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
<?php endif; ?>
<script>
    $(document).ready(function() {
        $('.role-row').on('click', function() {
            var roleId = $(this).data('role-id');

            var list = $('#role-permissions-list');
            list.empty();
            $('.role-row').removeClass('bg-blue-100');
            $(this).addClass('bg-blue-100');


            if (roleId) {
                $.ajax({
                    url: `/roles/${roleId}/permissions`,
                    method: 'GET',
                    success: function(response) {
                        if (response.permissions.length > 0) {
                            response.permissions.forEach(function(permission) {
                                list.append(`<li>${permission}</li>`);
                            });
                        } else {
                            list.append('<li>No permissions assigned to this role.</li>');
                        }
                    },
                    error: function() {
                        list.append('<li>Error fetching permissions.</li>');
                    }
                });
            }
        });
    });
</script>
<?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/roles_permissions/index.blade.php ENDPATH**/ ?>