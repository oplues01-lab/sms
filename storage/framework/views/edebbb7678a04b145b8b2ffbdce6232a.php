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
<div class="max-w-4xl mx-auto p-6">

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-xl">Capture Student Photo</h2>
            <a href="<?php echo e(route('students.detail', $student->id)); ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to Profile
            </a>
        </div>

        <!-- Current Photo -->
        <?php if($student->photo): ?>
        <div class="mb-6 text-center">
            <h3 class="font-semibold mb-2">Current Photo</h3>
            <img src="<?php echo e(Storage::url('students/' . $student->photo)); ?>" 
                 class="w-32 h-32 rounded-full border mx-auto object-cover">
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- LIVE CAMERA -->
            <div>
                <h3 class="font-semibold mb-2">Option 1: Live Capture</h3>
                <video id="video" autoplay playsinline class="w-full border rounded mb-3" style="max-height: 300px;"></video>
                <button type="button" id="captureBtn" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    📷 Capture Photo
                </button>
            </div>

            <!-- UPLOAD -->
            <div>
                <h3 class="font-semibold mb-2">Option 2: Upload Photo</h3>
                <div class="border-2 border-dashed border-gray-300 rounded p-6 text-center">
                    <input 
                        type="file" 
                        id="uploadPhoto" 
                        accept="image/*" 
                        class="hidden"
                    />
                    <label for="uploadPhoto" class="cursor-pointer">
                        <div class="text-gray-600 mb-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="text-sm">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 5MB</p>
                    </label>
                </div>
            </div>

        </div>

        <!-- Preview -->
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Preview</h3>
            <div class="border rounded p-4 bg-gray-50 text-center">
                <canvas id="canvas" class="mx-auto border rounded" style="display: none; max-width: 100%;"></canvas>
                <p id="noPreview" class="text-gray-500">No photo captured yet</p>
            </div>
        </div>

        <!-- FORM -->
        <form id="photoForm" action="<?php echo e(route('students.photo.store', $student->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="photo" id="photoInput">

            <div class="flex gap-3 mt-6">
                <button type="submit" id="saveBtn" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700" disabled>
                    💾 Save Photo
                </button>
                <button type="button" id="resetBtn" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    🔄 Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('captureBtn');
    const photoInput = document.getElementById('photoInput');
    const uploadPhoto = document.getElementById('uploadPhoto');
    const saveBtn = document.getElementById('saveBtn');
    const resetBtn = document.getElementById('resetBtn');
    const noPreview = document.getElementById('noPreview');

    let stream = null;

    const constraints = { 
        video: { 
            facingMode: "user",
            width: { ideal: 640 },
            height: { ideal: 480 }
        }, 
        audio: false 
    };

    // Start camera
    function startCamera() {
        navigator.mediaDevices.getUserMedia(constraints)
            .then(s => {
                stream = s;
                video.srcObject = stream;
            })
            .catch(err => {
                console.log("Camera error: ", err);
                alert("Unable to access camera. Please check permissions or use upload option.");
            });
    }

    startCamera();

    // Capture from camera
    captureBtn.addEventListener('click', () => {
        if (!video.videoWidth || !video.videoHeight) {
            alert("Camera not ready. Please wait a moment.");
            return;
        }

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);

        canvas.style.display = 'block';
        noPreview.style.display = 'none';

        const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
        photoInput.value = dataUrl;
        saveBtn.disabled = false;
    });

    // Upload from gallery
    uploadPhoto.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert("File size must be less than 5MB");
            return;
        }

        // Validate file type
        if (!file.type.match('image.*')) {
            alert("Please select an image file");
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                // Resize if too large
                let width = img.width;
                let height = img.height;
                const maxDimension = 1024;

                if (width > maxDimension || height > maxDimension) {
                    if (width > height) {
                        height = (height / width) * maxDimension;
                        width = maxDimension;
                    } else {
                        width = (width / height) * maxDimension;
                        height = maxDimension;
                    }
                }

                canvas.width = width;
                canvas.height = height;
                canvas.getContext('2d').drawImage(img, 0, 0, width, height);

                canvas.style.display = 'block';
                noPreview.style.display = 'none';

                // Save as base64 for backend
                photoInput.value = canvas.toDataURL('image/jpeg', 0.8);
                saveBtn.disabled = false;
            }
            img.src = event.target.result;
        }

        reader.readAsDataURL(file);
    });

    // Reset
    resetBtn.addEventListener('click', () => {
        canvas.style.display = 'none';
        noPreview.style.display = 'block';
        photoInput.value = '';
        saveBtn.disabled = true;
        uploadPhoto.value = '';
    });

    // Stop camera when leaving page
    window.addEventListener('beforeunload', () => {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\resources\views/students/photo.blade.php ENDPATH**/ ?>