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
            🧾 Student Report Card
        </h2>
     <?php $__env->endSlot(); ?>

    <style>
        body {
            background-color: #f5f5f5;
        }

        .report-card {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header-section {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            color: white;
            padding: 30px 40px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .school-name {
            font-size: 28px;
            font-weight: bold;
        }

        .report-title {
            background-color: #e8f0ff;
            text-align: center;
            padding: 20px;
            border-bottom: 3px solid #001f3f;
        }

        .report-title h1 {
            font-size: 32px;
            font-weight: bold;
            color: #001f3f;
        }

        .content-section {
            padding: 30px;
        }

        .student-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-row {
            border-bottom: 1px solid #ddd;
            padding: 6px 0;
            display: flex;
        }

        .info-label {
            font-weight: bold;
            width: 160px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #001f3f;
            color: white;
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }

        th:first-child, td:first-child {
            text-align: left;
        }

        .statistics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            text-align: center;
            padding: 15px;
            border: 2px solid #ddd;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
        }

        .signatures {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature-line {
            border-bottom: 2px solid black;
            width: 200px;
            height: 40px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background: white;
            }
        }
    </style>

    <div class="py-8">

        <!-- Buttons -->
        <div class="max-w-5xl mx-auto no-print mb-4">
            <button onclick="window.history.back()" 
                class="bg-gray-600 text-white px-4 py-2 rounded">
                ← Back
            </button>

            <button onclick="window.print()" 
                class="bg-blue-600 text-white px-4 py-2 rounded">
                🖨️ Print
            </button>
        </div>

        <div class="report-card">

            <!-- Header -->
            <div class="header-section">
                <div>
                    <div class="school-name">
                        <?php echo e(config('app.name') ?? 'School Name'); ?>

                    </div>
                    <div>Official Student Report Card</div>
                </div>
            </div>

            <!-- Title -->
            <div class="report-title">
                <h1>REPORT CARD</h1>
            </div>

            <!-- Content -->
            <div class="content-section">

                <!-- Student Info -->
                <div class="student-info">

                    <div>
                        <div class="info-row">
                            <div class="info-label">Student Name:</div>
                            <div>
                                <?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?>

                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Admission No:</div>
                            <div><?php echo e($student->admission_no); ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class:</div>
                            <div><?php echo e($student->classes->name ?? '-'); ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Arm:</div>
                            <div><?php echo e($student->class_arm->name ?? '-'); ?></div>
                        </div>
                    </div>

                    <div>

                      <div class="info-row">
    <div class="info-label">Term:</div>
    <div><?php echo e($term->name ?? $term_id); ?></div>
</div>

<div class="info-row">
    <div class="info-label">Session:</div>
    <div><?php echo e($session->name ?? $session_id); ?></div>
</div>

                        <div class="info-row">
                            <div class="info-label">Total Score:</div>
                            <div><?php echo e($total_score); ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Average:</div>
                            <div><?php echo e(number_format($average_score, 2)); ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class Arm Position:</div>
                            <div><?php echo e($classArmPosition); ?></div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class Position:</div>
                            <div><?php echo e($classPosition); ?></div>
                        </div>


                    </div>

                </div>

                <!-- Subjects Table -->
                <table>
    <thead>
        <tr>
            <th>Subject</th>
            <th>CA</th>
            <th>Exam</th>
            <th>Total</th>
            <th>Highest</th>
            <th>Average</th>
            <th>Lowest</th>
            <th>Grade</th>
            <th>Position</th>
        </tr>
    </thead>

    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($result->subject->name ?? '-'); ?></td>
                <td><?php echo e($result->ca_score); ?></td>
                <td><?php echo e($result->exam_score); ?></td>
                <td><?php echo e($result->total); ?></td>
                <td><?php echo e($result->subject_highest ?? '-'); ?></td>
                <td><?php echo e(number_format($result->subject_average ?? 0, 2)); ?></td>
                <td><?php echo e($result->subject_lowest ?? '-'); ?></td>
                <td><strong><?php echo e($result->grade ?? '-'); ?></strong></td>
                <td><strong><?php echo e($result->subject_position ?? '-'); ?></strong></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9">No Results Found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


                <!-- Statistics -->
                <div class="statistics">

                    <div class="stat-card">
                        <div>Total Score</div>
                        <div class="stat-value">
                            <?php echo e($total_score); ?>

                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Average Score</div>
                        <div class="stat-value">
                            <?php echo e(number_format($average_score, 2)); ?>

                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Grade</div>
                        <div class="stat-value">
                            <?php echo e($overall_grade ?? '-'); ?>

                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Class Arm Position</div>
                        <div class="stat-value">
                            <?php echo e($classArmPosition); ?>

                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Class Position</div>
                        <div class="stat-value">
                            <?php echo e($classPosition); ?>

                        </div>
                    </div>


                </div>

                <!-- Signatures -->
                <div class="signatures">

                    <div>
                        <div class="signature-line"></div>
                        Class Teacher Signature
                    </div>

                    <div>
                        <div class="signature-line"></div>
                        Principal Signature
                    </div>

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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\student_mgt_syst-main\student_mgt_syst-main\resources\views\student_results\teacher\reportcard.blade.php ENDPATH**/ ?>