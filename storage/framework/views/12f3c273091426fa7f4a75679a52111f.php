<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Questions Export</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .metadata {
            margin: 10px 0;
            font-size: 13px;
        }
        .metadata-row {
            display: inline-block;
            margin-right: 30px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold;
        }
        .question-num {
            width: 40px;
            text-align: center;
        }
        .marks-col {
            width: 50px;
            text-align: center;
        }
        .options {
            font-size: 11px;
            margin: 5px 0;
        }
        .correct-answer {
            font-weight: bold;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Questions Bank</h1>
        <div class="metadata">
            <span class="metadata-row"><strong>Class:</strong> <?php echo e($metadata['class']); ?></span>
            <span class="metadata-row"><strong>Subject:</strong> <?php echo e($metadata['subject']); ?></span>
            <span class="metadata-row"><strong>Term:</strong> <?php echo e($metadata['term']); ?></span>
        </div>
        <div class="metadata">
            <span class="metadata-row"><strong>Session:</strong> <?php echo e($metadata['session']); ?></span>
            <span class="metadata-row"><strong>Type:</strong> <?php echo e($metadata['type']); ?></span>
            <span class="metadata-row"><strong>Total Questions:</strong> <?php echo e($questions->count()); ?></span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="question-num">#</th>
                <th>Question & Options</th>
                <th class="marks-col">Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="question-num"><?php echo e($index + 1); ?></td>
                <td>
                    <strong><?php echo e($q->question); ?></strong>
                    <?php if($q->option_a || $q->option_b || $q->option_c || $q->option_d): ?>
                    <div class="options">
                        <?php if($q->option_a): ?>
                        <div class="<?php echo e($q->correct_option == 'A' ? 'correct-answer' : ''); ?>">
                            A. <?php echo e($q->option_a); ?>

                        </div>
                        <?php endif; ?>
                        <?php if($q->option_b): ?>
                        <div class="<?php echo e($q->correct_option == 'B' ? 'correct-answer' : ''); ?>">
                            B. <?php echo e($q->option_b); ?>

                        </div>
                        <?php endif; ?>
                        <?php if($q->option_c): ?>
                        <div class="<?php echo e($q->correct_option == 'C' ? 'correct-answer' : ''); ?>">
                            C. <?php echo e($q->option_c); ?>

                        </div>
                        <?php endif; ?>
                        <?php if($q->option_d): ?>
                        <div class="<?php echo e($q->correct_option == 'D' ? 'correct-answer' : ''); ?>">
                            D. <?php echo e($q->option_d); ?>

                        </div>
                        <?php endif; ?>
                        <?php if($q->correct_option): ?>
                        <div style="margin-top: 5px;">
                            <strong>Answer: <?php echo e($q->correct_option); ?></strong>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </td>
                <td class="marks-col"><?php echo e($q->marks); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\teacher\questions\pdf.blade.php ENDPATH**/ ?>