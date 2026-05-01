<!DOCTYPE html>
<html>
<head>
    <title>Student ID Card</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .card { width: 350px; border: 1px solid #000; padding: 10px; }
        .front, .back { margin-bottom: 20px; }
        .photo { width: 100px; height: 100px; border-radius: 50%; border: 1px solid #000; }
    </style>
</head>
<body>
    <div class="card">
        <div class="front">
            <h3>Front</h3>
            <img src="<?php echo e(asset('storage/students/'.$student->photo)); ?>" class="photo">
            <p><strong><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></strong></p>
            <p>Reg No: <?php echo e($student->admission_no); ?></p>
            <p>Class: <?php echo e($student->classes->name ?? 'N/A'); ?></p>
            <p>Arm: <?php echo e($student->class_arm->name ?? 'N/A'); ?></p>
        </div>

        <div class="back">
            <h3>Back</h3>
            <p><strong>Term:</strong> <?php echo e($student->term->name ?? 'N/A'); ?></p>
            <p><strong>Session:</strong> <?php echo e($student->academicsessions->name ?? 'N/A'); ?></p>
            <p><strong>Email:</strong> <?php echo e($student->email); ?></p>
            <p><strong>Phone:</strong> <?php echo e($student->phone ?? 'N/A'); ?></p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\students\print_idcard.blade.php ENDPATH**/ ?>