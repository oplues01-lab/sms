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
        <h2 class="text-xl font-bold mb-6">Student ID Card</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="<?php echo e(route('students.idcard.side', [$student->id, 'front'])); ?>"
               class="border p-6 rounded-lg shadow hover:shadow-lg">
                <h3 class="font-bold text-lg">Front</h3>
                <p class="text-sm text-gray-500">Click to view</p>
            </a>

            <a href="<?php echo e(route('students.idcard.side', [$student->id, 'back'])); ?>"
               class="border p-6 rounded-lg shadow hover:shadow-lg">
                <h3 class="font-bold text-lg">Back</h3>
                <p class="text-sm text-gray-500">Click to view</p>
            </a>
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
<?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/students/idcard/index.blade.php ENDPATH**/ ?>