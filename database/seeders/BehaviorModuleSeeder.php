
<?php

// namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConductRecord;
use App\Models\Student;
use App\Models\User;

class BehaviorModuleSeeder extends Seeder
{
    public function run()
    {
        $students = Student::take(10)->get();
        $teacher = User::where('role', 'teacher')->first();

        foreach ($students as $student) {
            // Create positive conduct
            ConductRecord::create([
                'student_id' => $student->id,
                'recorded_by' => $teacher->id,
                'term_id' => 1,
                'academic_sessions_id' => 1,
                'type' => 'positive',
                'title' => 'Excellent Class Participation',
                'description' => 'Actively participated in class discussions',
                'points' => 10,
                'incident_date' => now()->subDays(5),
                'status' => 'acknowledged',
            ]);

            // Create negative conduct
            ConductRecord::create([
                'student_id' => $student->id,
                'recorded_by' => $teacher->id,
                'term_id' => 1,
                'academic_sessions_id' => 1,
                'type' => 'negative',
                'title' => 'Late to Class',
                'description' => 'Arrived 10 minutes late without excuse',
                'points' => -5,
                'incident_date' => now()->subDays(3),
                'severity' => 'minor',
                'status' => 'acknowledged',
            ]);
        }
    }
}