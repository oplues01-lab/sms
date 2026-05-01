          

<?php $__env->startSection('header'); ?>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Dashboard
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
          
          <!-- Page Content -->

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-700 rounded-lg shadow-lg p-6 mb-6">
        <h1 class="text-3xl font-bold text-white">My Profile</h1>
        <p class="text-purple-100 mt-2">View your student information</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Photo Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="text-center">
                    <?php if($student->photo): ?>
                        <img src="<?php echo e(Storage::url('students/' . $student->photo)); ?>" 
                             class="w-48 h-48 rounded-full mx-auto mb-4 object-cover border-4 border-blue-200 shadow-lg"
                             alt="<?php echo e($student->first_name); ?>">
                    <?php else: ?>
                        <div class="w-48 h-48 rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 mx-auto mb-4 flex items-center justify-center border-4 border-blue-200 shadow-lg">
                            <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="text-2xl font-bold text-gray-800 mb-1"><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></h2>
                    <p class="text-gray-600 mb-4"><?php echo e($student->admission_no); ?></p>
                    
                    <div class="inline-flex items-center px-4 py-2 rounded-full <?php echo e($student->status === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?> font-semibold">
                        <?php echo e($student->status === 1 ? 'Active Student' : 'Inactive'); ?>

                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Links</h3>
                <div class="space-y-2">
                    <a href="<?php echo e(route('students.portal.dashboard')); ?>" 
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="text-gray-700">Dashboard</span>
                    </a>
                    <a href="<?php echo e(route('students.assignments.index')); ?>" 
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-gray-700">Assignments</span>
                    </a>
                    <a href="<?php echo e(route('students.assignments.results')); ?>" 
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="text-gray-700">My Results</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="lg:col-span-2">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->first_name); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->last_name); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Middle Name</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->middle_name ?? 'N/A'); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Admission Number</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->admission_no); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Gender</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e(ucfirst($student->gender ?? 'N/A')); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Date of Birth</label>
                        <p class="text-lg text-gray-800 font-semibold">
                            <?php echo e($student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : 'N/A'); ?>

                        </p>
                    </div>

                    <?php if($student->email): ?>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->email); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($student->phone): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Phone Number</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->phone); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($student->address): ?>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->address); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Academic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Class</label>
                        <div class="flex items-center gap-2">
                            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold text-lg inline-block">
                                <?php echo e($student->classes->name ?? 'N/A'); ?>

                            </div>
                        </div>
                    </div>

                    <?php if($student->class_arm): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Class Arm</label>
                        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-bold text-lg inline-block">
                            <?php echo e($student->class_arm->name); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Current Term</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->term->name ?? 'N/A'); ?></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Academic Session</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->academicsessions->name ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Parent/Guardian Information (if available) -->
            <?php if($student->parent_name || $student->parent_phone || $student->parent_email): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Parent/Guardian Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if($student->parent_name): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Parent/Guardian Name</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->parent_name); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($student->parent_phone): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Parent Phone</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->parent_phone); ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if($student->parent_email): ?>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Parent Email</label>
                        <p class="text-lg text-gray-800 font-semibold"><?php echo e($student->parent_email); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.students.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\students\portal\profile.blade.php ENDPATH**/ ?>