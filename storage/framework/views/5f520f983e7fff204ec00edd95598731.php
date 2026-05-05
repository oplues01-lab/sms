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
    <h2 class="font-semibold text-xl">
        Staff ID Card — <?php echo e(ucfirst($side)); ?>

    </h2>
 <?php $__env->endSlot(); ?>

<style>
.id-card {
    width: 340px;
    height: 520px;
    border: 2px solid #1e40af;
    border-radius: 14px;
    margin: auto;
    padding: 16px;
    background: #fff;
}
</style>

<div class="py-8">
    <div class="id-card">

        <?php if($side === 'front'): ?>
            <div class="text-center">
                <h3 class="font-bold text-lg">YOUR SCHOOL NAME</h3>

                <img
                    src="<?php echo e(asset('storage/staff/'.$staff->photo)); ?>"
                    class="w-28 h-28 rounded-full mx-auto mt-4 object-cover"
                >

                <h4 class="mt-4 font-semibold">
                    <?php echo e($staff->user->name); ?>

                </h4>

                <p class="text-sm text-gray-600">
                    <?php echo e($staff->designation); ?>

                </p>

                <p class="mt-3 text-xs">
                    Staff ID: <?php echo e(str_pad($staff->id, 5, '0', STR_PAD_LEFT)); ?>

                </p>
            </div>
        <?php else: ?>
            <div class="text-sm">
                <p><strong>School:</strong> YOUR SCHOOL NAME</p>
                <p><strong>Location:</strong> Nigeria</p>

                <div class="mt-6">
                    <p>
                        This card remains the property of the school.
                        If found, please return it immediately.
                    </p>
                </div>

                <div class="mt-10 text-right">
                    ___________________<br>
                    Authorized Signature
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="text-center mt-5">
        <button onclick="window.print()"
                class="px-4 py-2 bg-green-600 text-white rounded">
            Print ID Card
        </button>
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
<?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/staff/id_card.blade.php ENDPATH**/ ?>