<?php

namespace App\Http\Controllers;
use App\Models\Term;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Class_arm;
use App\Models\StudentResult;
use App\Models\SubjectTeacher;
use App\Models\AcademicSession;
use App\Http\Requests\StoreStudentResultRequest;
use App\Http\Requests\UpdateStudentResultRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Allocation;  
use App\Http\Services\ResultService;
use App\Http\StudentComment;
use App\Models\Comment;

class StudentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $teacher = auth()->user();
    //     $classes = Classes::all();
    //     $classarms = Class_arm::all();
    //     $academic_sessions = AcademicSession::all();
    //     $subjects =  Subject::all();

    //     $results = StudentResult::with(['subject', 'classes','classarm','student'])
    //     ->where(['class_id', $classes->id, 'class_arm_id', $classarms->, 'session_id', $academic_sessions->id, 'subject_id', $subjects->id])->get();
    //     return view('student_results.teacher.index', compact('results'));
    // }
public function index(Request $request)
{
   
   $terms = Term::all();  
        $academic_sessions = AcademicSession::all();
        $subjects = Subject::all();
        $classes = Classes::all();
        $classarms = Class_arm::all();
        $teachers = auth()->user();
        $students = Student::all();
        
   
   
   
    // $results = StudentResult::with(['subject', 'classes', 'classarm', 'student'])
    //     ->when($request->class_id, fn($q) => $q->where('class_id', $request->class_id))
    //     ->when($request->class_arm_id, fn($q) => $q->where('class_arm_id', $request->class_arm_id))
    //     ->when($request->session_id, fn($q) => $q->where('session_id', $request->session_id))
    //     ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
    //     ->get();

    // return view('student_results.teacher.index', compact('results'));
    
        return view('student_results.teacher.index', compact('students','teachers','classarms','subjects','classes','classarms','terms','academic_sessions'));

}


public function create()
{
    $terms = Term::all();  
    $academic_sessions = AcademicSession::all();
    $subjects = Subject::all();
    $classes = Classes::all();
    $classarms = Class_arm::all();
    $teachers = auth()->user();
    $students = Student::all();
 // Add this
    $allocations = SubjectTeacher::with(['subject', 'classes','classarm'])
        ->where('teacher_id', $teachers->id)
        ->get();
    return view('student_results.teacher.create', compact(
        'terms','academic_sessions','subjects','classes','classarms','teachers','students', 'allocations'
    ));
}


    public function getResults(Request $request){


    

         $results = StudentResult::with(['subject', 'classes', 'classarm', 'student'])
        ->when($request->class_id, fn($q) => $q->where('class_id', $request->input('class_id')))
        ->when($request->class_arm_id, fn($q) => $q->where('class_arm_id', $request->input('class_arm_id')))
        ->when($request->session_id, fn($q) => $q->where('session_id', $request->input('session_id')))
        ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->input('subject_id')))
        ->get();

    // return view('student_results.teacher.index', compact('results'));
   return response()->json($results);

    }




 


public function masterresult(Request $request)
{
   
   $terms = Term::all();  
    $academic_sessions = AcademicSession::all();
    $subjects = Subject::all();
    $classes = Classes::all();
    $classarms = Class_arm::all();
    $teachers = auth()->user();
    $students = Student::all();
        
   

    return view('student_results.teacher.masterresult', 
    compact('teachers','classarms','subjects','classes','classarms','terms','academic_sessions'));

}



public function reportcard1(Request $request)
    {
        $admission_no = $request->query('admission_no');
        $class_id = $request->query('class_id');
        $class_arm_id = $request->query('class_arm_id');
        $term_id = $request->query('term_id');
        $session_id = $request->query('session_id');

        // Fetch student
        $student = Student::with(['classes', 'class_arm'])
            ->where('admission_no', $admission_no)
            ->first();

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

        // Fetch ONLY this student's results
    // Fetch ONLY this student's results
    $subjects = StudentResult::with(['subject'])
        ->where('student_id', $student->id)
        ->where('class_id', $class_id)
        ->where('class_arm_id', $class_arm_id)
        ->where('session_id', $session_id)
        ->where('term_id', $term_id)
        ->get();
        // Calculate total and average
        $total_score = $subjects->sum('total');

        $average_score = $subjects->count() > 0
            ? round($total_score / $subjects->count(), 2)
            : 0;

        $term = Term::find($term_id);
    $session = AcademicSession::find($session_id);

    return view('student_results.teacher.reportcard', [
        'student' => $student,
        'subjects' => $subjects,
        'total_score' => $total_score,
        'average_score' => $average_score,
        'term' => $term,
        'session' => $session,
        'class_id' => $class_id,
        'class_arm_id' => $class_arm_id,
    ]);
    }

public function reportcard(Request $request)
{

    /*
    |--------------------------------------------------------------------------
    | Get parameters from master sheet link
    |--------------------------------------------------------------------------
    */

    $admission_no = $request->query('admission_no');

    $class_id = $request->query('class_id');

    $class_arm_id = $request->query('class_arm_id');

    $term_id = $request->query('term_id');

    $session_id = $request->query('session_id');



    /*
    |--------------------------------------------------------------------------
    | Get student
    |--------------------------------------------------------------------------
    */

    $student = Student::with(['classes','class_arm'])
        ->where('admission_no', $admission_no)
        ->firstOrFail();



    /*
    |--------------------------------------------------------------------------
    | Get results scopes
    |--------------------------------------------------------------------------
    */

    $classArmResults =
        ResultService::getClassArmResults(
            $class_id,
            $class_arm_id,
            $session_id,
            $term_id
        );


    $classResults =
        ResultService::getClassResults(
            $class_id,
            $session_id,
            $term_id
        );



    /*
    |--------------------------------------------------------------------------
    | Student results
    |--------------------------------------------------------------------------
    */

    $studentResults =
        $classArmResults
        ->where('student_id', $student->id)
        ->values();



    /*
    |--------------------------------------------------------------------------
    | Subject calculations (Class Arm)
    |--------------------------------------------------------------------------
    */

    $subjectAverages =
        ResultService::calculateSubjectAverages($classArmResults);


    $subjectPositions =
        ResultService::calculateSubjectPositions($classArmResults);



    /*
    |--------------------------------------------------------------------------
    | Class Arm Position
    |--------------------------------------------------------------------------
    */

    $classArmPositions =
        ResultService::calculateClassArmPositions($classArmResults);



    /*
    |--------------------------------------------------------------------------
    | Overall Class Position
    |--------------------------------------------------------------------------
    */

    $classPositions =
        ResultService::calculateClassPositions($classResults);



    /*
    |--------------------------------------------------------------------------
    | Scores
    |--------------------------------------------------------------------------
    */

    $total_score =
        $studentResults->sum('total');


    $average_score =
        ResultService::calculateStudentAverage($studentResults);


    $overall_grade =
        ResultService::calculateGrade($average_score);



    /*
    |--------------------------------------------------------------------------
    | Positions
    |--------------------------------------------------------------------------
    */

    $classArmPosition =
        $classArmPositions[$total_score] ?? '-';


    $classPosition =
        $classPositions[$total_score] ?? '-';



    /*
    |--------------------------------------------------------------------------
    | Attach subject position and averages
    |--------------------------------------------------------------------------
    */

    // First, calculate subject positions and stats
$subjectStats = ResultService::calculateSubjectStats($classArmResults);

// Map over student results once
$studentResults->transform(function ($result) use ($subjectStats, $subjectPositions, $student) {
    $stats = $subjectStats[$result->subject_id] ?? ['highest' => 0, 'lowest' => 0, 'average' => 0];
    $result->subject_highest = $stats['highest'];
    $result->subject_lowest = $stats['lowest'];
    $result->subject_average = $stats['average'];
    $result->subject_position = $subjectPositions[$student->id][$result->subject_id] ?? '-';
    $result->grade = ResultService::calculateGrade($result->total ?? 0);
    return $result;
});



    /*
    |--------------------------------------------------------------------------
    | Term and Session
    |--------------------------------------------------------------------------
    */

    $term = Term::find($term_id);

    $session = AcademicSession::find($session_id);




    // In StudentResultController reportcard method, add before return view:

$classTeacherComment = Comment::where([
    'student_id' => $student->id,
    'term_id' => $term_id,
    'session_id' => $session_id,
    'comment_type' => 'class_teacher',
])->first();

$principalComment = Comment::where([
    'student_id' => $student->id,
    'term_id' => $term_id,
    'session_id' => $session_id,
    'comment_type' => 'principal',
])->first();

// Then add to view data:

    /*
    |--------------------------------------------------------------------------
    | Return view
    |--------------------------------------------------------------------------
    */

    return view('student_results.teacher.reportcard', [

        'student' => $student,

        'subjects' => $studentResults,

        'total_score' => $total_score,

        'average_score' => $average_score,

        'overall_grade' => $overall_grade,

        'classArmPosition' => $classArmPosition,

        'classPosition' => $classPosition,

        'term' => $term,

        'session' => $session,
        'classTeacherComment' => $classTeacherComment?->comment,
        'principalComment' => $principalComment?->comment,

    ]);

}








public function getMasterResults(Request $request)
{
   

    $class_id = $request->input('class_id');
    $class_arm_id = $request->input('class_arm_id');
    $session_id = $request->input('session_id');
    $term_id = $request->input('term_id');

    // Get all subjects for that class/arm
    $subjects = Subject::all(['id', 'name']);

    // Get all results filtered
    $results = StudentResult::with(['student:id,first_name,last_name,admission_no', 'subject:id,name'])
        ->where('class_id', $class_id)
        ->where('class_arm_id', $class_arm_id)
        ->where('session_id', $session_id)
        ->where('term_id', $term_id)
        ->get();

    // Group by student
    $grouped = $results->groupBy('student_id')->map(function ($rows) use ($subjects) {
        $student = $rows->first()->student;
        $subjectScores = [];

        // Initialize all subjects with 0
        foreach ($subjects as $sub) {
            $subjectScores[$sub->name] = null;
        }

        // Fill subjects with actual total
        foreach ($rows as $r) {
            $subjectScores[$r->subject->name] = $r->total;
        }

        // Compute total, average, grade
        $validScores = array_filter($subjectScores, fn($v) => !is_null($v));
        $total = array_sum($validScores);
        $average = count($validScores) > 0 ? round($total / count($validScores), 2) : 0;
        $grade = match (true) {
            $total >= 70 => 'A',
            $total >= 60 => 'B',
            $total >= 50 => 'C',
            $total >= 45 => 'D',
            default => 'F',
        };

        return [
            'student_name' => $student->first_name . ' ' . $student->last_name,
            'admission_no' => $student->admission_no,
            'subjects' => $subjectScores,
            'total' => $total,
            'average' => $average,
            'grade' => $grade,
        ];
    })->values();

    // Sort by total to assign position
    $sorted = $grouped->sortByDesc('total')->values();
    $ranked = $sorted->map(function ($item, $index) {
        $item['position'] = $index + 1;
        return $item;
    });

    // Return subjects + ranked results
    return response()->json([
        'subjects' => $subjects->pluck('name'),
        'results' => $ranked,
    ]);
}













    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreStudentResultRequest $request)
        {
            //


            // print_r($request);
            // exit;
            $validated = $request->validated();
            $validated['recorded_by'] = auth()->id();
            // $validated['total'] = $validated['ca_score'] + $validated['exam_score'];
            // add admission_no automatically

        // fetch student using student_id
        $student = Student::find($validated['student_id']);

        if (!$student) {
            return back()->with('error', 'Student not found');
        }

            $validated['admission_no'] = $student->admission_no;

            StudentResult::updateOrCreate(

        [
            'student_id' => $validated['student_id'],
            'subject_id' => $validated['subject_id'],
            'term_id' => $validated['term_id'],
            'session_id' => $validated['session_id'],
        ],
                $validated
    );

            return back()->with('success', 'Result recorded successfully!');

        }



 public function uploadResult()
{
    $terms = Term::all();  
    $academic_sessions = AcademicSession::all();
    $teachers = auth()->user();

    // Only fetch allocations for this teacher
    $allocations = SubjectTeacher::with(['subject', 'classes', 'classarm'])
        ->where('teacher_id', $teachers->id)
        ->get();

    // Get only students in the teacher's allocated classes & arms
    $students = Student::whereIn('class_id', $allocations->pluck('class_id'))
        ->whereIn('class_arm_id', $allocations->pluck('classarm_id'))
        ->get();

    return view('student_results.teacher.upload_results', compact(
        'allocations',
        'students',
        'teachers',
        'terms',
        'academic_sessions'
    ));
}



    public function getStudents(Request $request){
        // dump('kkkkkk');
        // die;
     
        $class_id = $request->input('class_id');
        $class_arm_id = $request->input('class_arm_id');
        $subject_id = $request->input('subject_id');
        $session_id = $request->input('session_id');
        $term_id = $request->input('term_id');
        // student with resullt for this subject, claass, arm, session
    
        $studentWithResults = StudentResult::where([
            'class_id' => $class_id,
            'class_arm_id' => $class_arm_id,
            'subject_id' => $subject_id, 
            'session_id' => $session_id,
            'term_id'  => $term_id


        ])->pluck('admission_no');

        // get student without result 

        $students = Student::where([
            'class_id' => $class_id,
            'class_arm_id' => $class_arm_id,
            'academic_sessions_id' => $session_id,
            'term_id'  => $term_id])->whereNotIn('admission_no', $studentWithResults)
                                    ->select('id','admission_no', 'first_name', 'last_name')->with(
                        [
                            'term:id,name',
                            'classes:id,name', 
                            'class_arm:id,name',
                            'academicsessions:id,name'
                            ]
                        )->get();    
        $students = $students->map(function($student){
            $student->name = $student->first_name . ' ' . $student->last_name;
            return $student;
        });
        return response()->json($students);


    }




    public function getStudents1(Request $request){
        $class_id = $request->input('class_id');
        $class_arm_id = $request->input('class_arm_id');

        $students = Student::where('class_id',  $class_id)
                            ->where('class_arm_id', $class_arm_id)
                            ->select('id','admission_no', 'first_name', 'last_name')->with(
                                [
                                    'term:id,name',
                                    'classes:id,name', 
                                    'class_arm:id,name',
                                    'academicsessions:id,name'
                                    ]
                                )->get();
        
        
        $students = $students->map(function($student){
            $student->name = $student->first_name . ' ' . $student->last_name;
        return $student;
         });
        return response()->json($students);
    }






public function getStudents2(Request $request){
    \Log::info('Get Students Request:', $request->all());
    
    try {
        $class_id = $request->input('class_id');
        $class_arm_id = $request->input('class_arm_id');

        if(!$class_id || !$class_arm_id) {
            return response()->json(['error' => 'Class and Class Arm are required'], 400);
        }

        $students = Student::where('class_id', $class_id)
                            ->where('class_arm_id', $class_arm_id)
                            ->select('id', 'admission_no', 'first_name', 'last_name')
                            ->get();
        
        \Log::info('Found students:', ['count' => $students->count()]);
        
        $students = $students->map(function($student){
            $student->name = $student->first_name . ' ' . $student->last_name;
            return $student;
        });
        
        return response()->json($students);
        
    } catch (\Exception $e) {
        \Log::error('Error in getStudents: ' . $e->getMessage());
        return response()->json(['error' => 'Server error'], 500);
    }
}














    public function storeUpload(Request $request)
{
    $validated = $request->validate([
        'student_id.*' => 'required|integer',
        'admission_no.*' => 'required|string',
        'ca_score.*' => 'required|numeric|min:0',
        'exam_score.*' => 'required|numeric|min:0',
        'session_id' => 'required|integer',
        'term_id' => 'required|integer',
        'subject_id' => 'required|integer',
        'class_id' => 'required|integer',
        'class_arm_id' => 'required|integer',
    ]);

    foreach ($validated['student_id'] as $key => $studentId) {
        // Check if result already exists
        $exists = StudentResult::where([
            'student_id' => $studentId,
            'subject_id' => $validated['subject_id'],
            'term_id' => $validated['term_id'],
            'session_id' => $validated['session_id'],
            'class_id' => $validated['class_id'],
            'class_arm_id' => $validated['class_arm_id'],
            'admission_no' => $validated['admission_no'][$key],
        ])->exists();

        if (!$exists) {
            // Only insert if it doesn't exist
            StudentResult::create([
                'student_id' => $studentId,
                'subject_id' => $validated['subject_id'],
                'term_id' => $validated['term_id'],
                'session_id' => $validated['session_id'],
                'class_id' => $validated['class_id'],
                'class_arm_id' => $validated['class_arm_id'],
                'admission_no' => $validated['admission_no'][$key],
                'ca_score' => $validated['ca_score'][$key],
                'exam_score' => $validated['exam_score'][$key],
                'recorded_by' => auth()->id(),
            ]);
        }
    }

    return back()->with('success', 'Results recorded successfully!');
}



    public function subjectResults(Request $request){

        $results = StudentResult::where([
        'subject_id' => $request->subject_id,
        'class_id' => $request->class_id,
        'class_arm_id' => $request->class_arm_id,
        'term_d' => $request->term_id,
        'session_id' => $request->session_id,
        ])->orderBy('total', 'desc')->with('student')->get();

            return view('student_results.teacher.view', compact('results'));

    }







    /**
     * Display the specified resource.
     */
    public function show(StudentResult $studentResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentResult $studentResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentResultRequest $request, StudentResult $studentResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentResult $studentResult)
    {
        //
    }
}
