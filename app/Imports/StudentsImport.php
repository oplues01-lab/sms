<?php


namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    protected $class_id;
    protected $class_arm_id;
    protected $term_id;
    protected $academic_sessions_id;
    protected static $serialCounter = null;







    public function __construct($class_id, $class_arm_id, $term_id, $academic_sessions_id)
    {
        $this->class_id = $class_id;
        $this->class_arm_id = $class_arm_id;
        $this->term_id = $term_id;
        $this->academic_sessions_id = $academic_sessions_id;

        // initialize counter only once
        if (self::$serialCounter === null) {

          $lastAdNo = Student::where('academic_sessions_id', $this->academic_sessions_id)
    ->latest('id')
    ->value('admission_no');


            self::$serialCounter = $lastAdNo
                ? (int) substr($lastAdNo, -2)
                : 0;
        }
    }

    public function model(array $row)
    {


        return DB::transaction(function () use ($row) {
              // Skip empty rows
        if (!isset($row['first_name']) || empty($row['first_name'])) {
            return null;
        }

        // dump($row); die;

            $first_name = $row['first_name'] ?? null; // Column A
            $last_name = $row['last_name'] ?? null;  // Column B
            $email = $row['email'] ?? null;     
            // Create user
            $user = User::create([

                'name' => $first_name . ' '. $last_name,
                'email' => $email,
                'password' => bcrypt('student1'),
            ]);
            $user->assignRole('student');

            // Generate admission number
            // $lastAdNo = Student::where('class_id', $this->class_id)->latest('id')->value('admission_no');
            $lastAdNo = Student::where('academic_sessions_id', $this->academic_sessions_id)
    ->latest('id')
    ->value('admission_no');

            $serial = $lastAdNo ? (int)substr($lastAdNo, -2) + 1 : 1;


            self::$serialCounter++;

        $adno = sprintf(
            'PSA/%s/%02d',
            now()->year,
            self::$serialCounter
        );

            $rpin = $user->id . $user->id . substr($adno, -2);

            return Student::create([
                'user_id' => $user->id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                // 'email' => $email,
                'admission_no' => $adno,
                'rpin' => $rpin,
                'class_id' => $this->class_id,
                'class_arm_id' => $this->class_arm_id,
                'term_id' => $this->term_id,
                'academic_sessions_id' => $this->academic_sessions_id,
            ]);
        });
    }
}
