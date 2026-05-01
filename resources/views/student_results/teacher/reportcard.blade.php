<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧾 Student Report Card
        </h2>
    </x-slot>

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


        /* Comments Section */
.comments-section {
    margin-top: 40px;
    border-top: 2px solid #001f3f;
    padding-top: 30px;
}

.comment-box {
    margin-bottom: 25px;
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    background-color: #f9fafb;
}

.comment-header {
    font-weight: bold;
    font-size: 16px;
    color: #001f3f;
    margin-bottom: 10px;
    padding-bottom: 8px;
    border-bottom: 2px solid #001f3f;
}

.comment-text {
    font-size: 14px;
    line-height: 1.6;
    color: #333;
    min-height: 60px;
    font-style: italic;
}

.no-comment {
    color: #999;
    font-style: italic;
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
                        {{ config('app.name') ?? 'School Name' }}
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
                                {{ $student->first_name }} {{ $student->last_name }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Admission No:</div>
                            <div>{{ $student->admission_no }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class:</div>
                            <div>{{ $student->classes->name ?? '-' }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Arm:</div>
                            <div>{{ $student->class_arm->name ?? '-' }}</div>
                        </div>
                    </div>

                    <div>

                      <div class="info-row">
    <div class="info-label">Term:</div>
    <div>{{ $term->name ?? $term_id }}</div>
</div>

<div class="info-row">
    <div class="info-label">Session:</div>
    <div>{{ $session->name ?? $session_id }}</div>
</div>

                        <div class="info-row">
                            <div class="info-label">Total Score:</div>
                            <div>{{ $total_score }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Average:</div>
                            <div>{{ number_format($average_score, 2) }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class Arm Position:</div>
                            <div>{{ $classArmPosition }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Class Position:</div>
                            <div>{{ $classPosition }}</div>
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
        @forelse($subjects as $result)
            <tr>
                <td>{{ $result->subject->name ?? '-' }}</td>
                <td>{{ $result->ca_score }}</td>
                <td>{{ $result->exam_score }}</td>
                <td>{{ $result->total }}</td>
                <td>{{ $result->subject_highest ?? '-' }}</td>
                <td>{{ number_format($result->subject_average ?? 0, 2) }}</td>
                <td>{{ $result->subject_lowest ?? '-' }}</td>
                <td><strong>{{ $result->grade ?? '-' }}</strong></td>
                <td><strong>{{ $result->subject_position ?? '-' }}</strong></td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No Results Found</td>
            </tr>
        @endforelse
    </tbody>
</table>


                <!-- Statistics -->
                <div class="statistics">

                    <div class="stat-card">
                        <div>Total Score</div>
                        <div class="stat-value">
                            {{ $total_score }}
                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Average Score</div>
                        <div class="stat-value">
                            {{ number_format($average_score, 2) }}
                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Grade</div>
                        <div class="stat-value">
                            {{ $overall_grade ?? '-' }}
                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Class Arm Position</div>
                        <div class="stat-value">
                            {{ $classArmPosition }}
                        </div>
                    </div>

                    <div class="stat-card">
                        <div>Class Position</div>
                        <div class="stat-value">
                            {{ $classPosition }}
                        </div>
                    </div>


                </div>


<!-- Comments Section -->
                <div class="comments-section">
                    <h3 style="font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #001f3f;">
                        📝 Comments
                    </h3>

                    <!-- Class Teacher Comment -->
                    <div class="comment-box">
                        <div class="comment-header">
                            👨‍🏫 Class Teacher's Comment
                        </div>
                        <div class="comment-text">
                            @if(!empty($classTeacherComment))
                                {{ $classTeacherComment }}
                            @else
                                <span class="no-comment">No comment provided yet.</span>
                            @endif
                        </div>
                    </div>

                    <!-- Principal Comment -->
                    <div class="comment-box">
                        <div class="comment-header">
                            👔 Principal's Comment
                        </div>
                        <div class="comment-text">
                            @if(!empty($principalComment ))
                                {{ $principalComment  }}
                            @else
                                <span class="no-comment">No comment provided yet.</span>
                            @endif
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

</x-app-layout>
