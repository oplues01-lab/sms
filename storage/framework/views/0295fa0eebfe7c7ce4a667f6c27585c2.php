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
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Student Comments Management</h2>

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <!-- Filter Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Comment Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Comment Type *</label>
                    <select id="comment_type" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Comment Type --</option>
                        <option value="class_teacher">Class Teacher Comment</option>
                        <option value="principal">Principal Comment</option>
                    </select>
                </div>

                <!-- Class -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Class *</label>
                    <select id="class_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Class --</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Class Arm -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Class Arm *</label>
                    <select id="class_arm_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Class Arm --</option>
                        <?php $__currentLoopData = $class_arms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($arm->id); ?>"><?php echo e($arm->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Term -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Term *</label>
                    <select id="term_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Term --</option>
                        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($term->id); ?>"><?php echo e($term->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Session -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Academic Session *</label>
                    <select id="session_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Session --</option>
                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($session->id); ?>"><?php echo e($session->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Load Button -->
                <div class="flex items-end">
                    <button id="load_students" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed" disabled>
                        Load Students
                    </button>
                </div>
            </div>

            <!-- Students List -->
            <div id="students_section" class="hidden">
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Select Student to Add/Edit Comment</h3>
                    
                    <div id="students_list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 mb-6">
                        <!-- Students will be loaded here via AJAX -->
                    </div>
                </div>
            </div>

            <!-- Comment Form -->
            <div id="comment_form_section" class="hidden">
                <div class="border-t pt-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">
                                Add/Edit Comment for: <span id="selected_student_name" class="text-blue-600"></span>
                            </h3>
                            <button id="close_form" class="text-red-600 hover:text-red-800 font-medium">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form id="comment_form">
                            <input type="hidden" id="form_student_id">
                            <input type="hidden" id="form_class_id">
                            <input type="hidden" id="form_class_arm_id">
                            <input type="hidden" id="form_term_id">
                            <input type="hidden" id="form_session_id">
                            <input type="hidden" id="form_comment_type">
                            <input type="hidden" id="form_comment_id">

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Comment * <span class="text-gray-500 text-xs">(Max 1000 characters)</span>
                                </label>
                                <textarea id="comment_text" rows="5" maxlength="1000" 
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="Enter your comment here..." required></textarea>
                                <div class="text-right text-sm text-gray-500 mt-1">
                                    <span id="char_count">0</span>/1000
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Save Comment
                                </button>
                                <button type="button" id="delete_comment" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 hidden">
                                    Delete Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div id="loading" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-5 rounded-lg shadow-xl">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-3 text-gray-700">Loading...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentType = document.getElementById('comment_type');
            const classId = document.getElementById('class_id');
            const classArmId = document.getElementById('class_arm_id');
            const termId = document.getElementById('term_id');
            const sessionId = document.getElementById('session_id');
            const loadStudentsBtn = document.getElementById('load_students');
            const studentsSection = document.getElementById('students_section');
            const studentsList = document.getElementById('students_list');
            const commentFormSection = document.getElementById('comment_form_section');
            const commentForm = document.getElementById('comment_form');
            const commentText = document.getElementById('comment_text');
            const charCount = document.getElementById('char_count');
            const closeFormBtn = document.getElementById('close_form');
            const deleteCommentBtn = document.getElementById('delete_comment');
            const loading = document.getElementById('loading');

            // Check if all required fields are selected
            function checkRequiredFields() {
                const allSelected = commentType.value && classId.value && classArmId.value && 
                                   termId.value && sessionId.value;
                loadStudentsBtn.disabled = !allSelected;
            }

            [commentType, classId, classArmId, termId, sessionId].forEach(el => {
                el.addEventListener('change', checkRequiredFields);
            });

            // Character count
            commentText.addEventListener('input', function() {
                charCount.textContent = this.value.length;
            });

            // Load students
            loadStudentsBtn.addEventListener('click', async function() {
                loading.classList.remove('hidden');
                commentFormSection.classList.add('hidden');

                try {
                    const response = await fetch('<?php echo e(route("comments.getStudents")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            class_id: classId.value,
                            class_arm_id: classArmId.value,
                            term_id: termId.value,
                            session_id: sessionId.value,
                            comment_type: commentType.value
                        })
                    });

                    const students = await response.json();
                    displayStudents(students);
                    studentsSection.classList.remove('hidden');
                } catch (error) {
                    alert('Error loading students: ' + error.message);
                } finally {
                    loading.classList.add('hidden');
                }
            });

            // Display students
            function displayStudents(students) {
                studentsList.innerHTML = '';

                students.forEach(student => {
                    const div = document.createElement('div');
                    div.className = `p-3 border rounded-md cursor-pointer transition-all ${
                        student.has_comment 
                            ? 'bg-green-50 border-green-300 hover:bg-green-100' 
                            : 'bg-white border-gray-300 hover:bg-gray-50'
                    }`;
                    
                    div.innerHTML = `
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">${student.full_name}</p>
                                <p class="text-sm text-gray-600">Reg No: ${student.admission_no}</p>
                            </div>
                            ${student.has_comment ? `
                                <div class="flex items-center gap-2">
                                    <span class="text-xs bg-green-600 text-white px-2 py-1 rounded">Has Comment</span>
                                    <button class="delete-comment-btn text-red-600 hover:text-red-800" data-comment-id="${student.comment_id}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            ` : ''}
                        </div>
                    `;

                    div.addEventListener('click', function(e) {
                        if (!e.target.closest('.delete-comment-btn')) {
                            openCommentForm(student);
                        }
                    });

                    // Delete button event
                    const deleteBtn = div.querySelector('.delete-comment-btn');
                    if (deleteBtn) {
                        deleteBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            deleteComment(student.comment_id, student.id);
                        });
                    }

                    studentsList.appendChild(div);
                });
            }

            // Open comment form
            function openCommentForm(student) {
                document.getElementById('selected_student_name').textContent = student.full_name;
                document.getElementById('form_student_id').value = student.id;
                document.getElementById('form_class_id').value = classId.value;
                document.getElementById('form_class_arm_id').value = classArmId.value;
                document.getElementById('form_term_id').value = termId.value;
                document.getElementById('form_session_id').value = sessionId.value;
                document.getElementById('form_comment_type').value = commentType.value;
                document.getElementById('form_comment_id').value = student.comment_id || '';
                
                commentText.value = student.comment || '';
                charCount.textContent = commentText.value.length;

                if (student.has_comment) {
                    deleteCommentBtn.classList.remove('hidden');
                } else {
                    deleteCommentBtn.classList.add('hidden');
                }

                commentFormSection.classList.remove('hidden');
                commentText.focus();
            }

            // Close form
            closeFormBtn.addEventListener('click', function() {
                commentFormSection.classList.add('hidden');
                commentForm.reset();
            });

            // Submit comment
            commentForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                loading.classList.remove('hidden');

                try {
                    const response = await fetch('<?php echo e(route("comments.store")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            student_id: document.getElementById('form_student_id').value,
                            class_id: document.getElementById('form_class_id').value,
                            class_arm_id: document.getElementById('form_class_arm_id').value,
                            term_id: document.getElementById('form_term_id').value,
                            session_id: document.getElementById('form_session_id').value,
                            comment_type: document.getElementById('form_comment_type').value,
                            comment: commentText.value
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        alert('Comment saved successfully!');
                        commentFormSection.classList.add('hidden');
                        loadStudentsBtn.click(); // Reload students
                    } else {
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    alert('Error saving comment: ' + error.message);
                } finally {
                    loading.classList.add('hidden');
                }
            });

            // Delete comment
            deleteCommentBtn.addEventListener('click', async function() {
                const commentId = document.getElementById('form_comment_id').value;
                if (commentId) {
                    deleteComment(commentId);
                }
            });

            async function deleteComment(commentId, studentId = null) {
                if (!confirm('Are you sure you want to delete this comment?')) {
                    return;
                }

                loading.classList.remove('hidden');

                try {
                    const response = await fetch(`/comments/${commentId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        }
                    });

                    const result = await response.json();

                    if (result.success) {
                        alert('Comment deleted successfully!');
                        commentFormSection.classList.add('hidden');
                        loadStudentsBtn.click(); // Reload students
                    } else {
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    alert('Error deleting comment: ' + error.message);
                } finally {
                    loading.classList.add('hidden');
                }
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/u347412978/domains/oplueaswebservices.com/sms/resources/views/student_comments/index.blade.php ENDPATH**/ ?>