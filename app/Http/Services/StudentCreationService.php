<?php 


namespace App\Http\Services;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class StudentCreationService 
{

    public function createStudent($data){

        return DB::transaction(function() use ($data){
            
        
            $plainPassword = 'student1';
            
            $user = User::create([
                "name" => $data["first_name"] . ' ' . $data['last_name'],
                "email" => $data["email"],
                "password" => bcrypt($plainPassword),


            ]);
            $user->assignRole('student');

            $lastAdNo = Student::where('class_id', $data['class_id'])->latest('id')->value('admission_no');
            $serial = $lastAdNo ? (int)substr($lastAdNo, -2) +1 : 1;
            $adno = sprintf('PSA/%s/%02d', now()->year, $serial);

            $rpin = $user->id . $user->id . substr($adno, -2);

            return Student::create([
                'user_id' => $user->id,
                'first_name' =>$data['first_name'],
                'last_name' =>$data['last_name'],
                // 'email' => $data['email'],
                'admission_no' => $adno,
                'rpin' => $rpin,
                'class_id' => $data['class_id'],
                'class_arm_id' => $data['class_arm_id'],
                'term_id' => $data['term_id'],
                'academic_sessions_id' =>$data['academic_sessions_id']
            ]);


        });
    }

}
