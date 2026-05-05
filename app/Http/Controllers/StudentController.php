<?php

namespace App\Http\Controllers;

use session;
use App\Models\Term;
use App\Models\AcademicSession;
use App\Models\Class_arm;
use App\Models\Classes;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Services\StudentCreationService;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $service;
    public function __construct(StudentCreationService $service){
        $this->service = $service;
    }


public function index(Request $request)
{
    $classes = Classes::all();
    $arms = Class_arm::all();
    $terms = Term::all();
    $sessions = AcademicSession::all();

    $query = Student::query();

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', "%{$request->search}%")
              ->orWhere('last_name', 'like', "%{$request->search}%")
              ->orWhere('admission_no', 'like', "%{$request->search}%");
        });
    }

    if ($request->class_id) {
        $query->where('class_id', $request->class_id);
    }

    if ($request->class_arm_id) {
        $query->where('class_arm_id', $request->class_arm_id);
    }

    if ($request->term_id) {
        $query->where('term_id', $request->term_id);
    }

    if ($request->academic_sessions_id) {
        $query->where('academic_sessions_id', $request->academic_sessions_id);
    }

    $students = $query->with(['classes', 'class_arm', 'term', 'academicsessions'])
                      ->paginate(20)
                      ->withQueryString();

    if ($request->ajax()) {
        return view('students.partials.student_table', compact('students'));
    }

    return view('students.index', compact('students', 'classes', 'arms', 'terms', 'sessions'));
}



    /**
     * Show the form for creating a new resource.
     */

public function detail(Student $student)
{
    return view('students.detail', compact('student'));
}

    public function create()
    {
        //
        $classes = \App\Models\Classes::all();
        $class_arms = \App\Models\Class_arm::all();
        $terms = Term::all();
        $academic_sessions = AcademicSession::all();


        return view('students.create', compact('classes', 'class_arms', 'terms', 'academic_sessions'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        //createStudent
        $validated = $request->validated();
        $student = $this->service->createStudent($validated);
        
        return back()->with("success", "Student created with admission no" . $student->admission_no);



    }



public function excelUpload(){
    //
        $classes = \App\Models\Classes::all();
        $class_arms = \App\Models\Class_arm::all();
        $terms = Term::all();
        $academic_sessions = AcademicSession::all();


        return view('students.excelUpload', compact('classes', 'class_arms', 'terms', 'academic_sessions'));
        
}



    

public function import(Request $request)
{
    // dump($request->file);
    // die;
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
        'class_id' => 'required|integer|exists:classes,id',
        'class_arm_id' => 'required|integer|exists:class_arms,id',
        'term_id' => 'required|integer|exists:terms,id',
        'academic_sessions_id' => 'required|integer|exists:academic_sessions,id',
    ]);

    Excel::import(
        new StudentsImport(
            $request->class_id,
            $request->class_arm_id,
            $request->term_id,
            $request->academic_sessions_id
        ),
        $request->file('file')
    );



    return back()->with('success', 'Students imported successfully!');
}








    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
        
        $student->load(['classes', 'class_arm','term', 'academicsessions']);
        
        return view('students.detail', compact('student'));

    }

    public function deactivate($id){
        $student = Student::find($id);
        if(!$student){
            abort(404);
        }
        $student->update(['status' => 0]);

        return back()->with('success', 'Student deactivated successfully');


    }

    public function activate($id){
        $student = Student::find($id);
        if(!$student){
            abort(404);
        }
        $student->update(['status' => 1]);

        return back()->with('success', 'Student activated successfully');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
         $classes = \App\Models\Classes::all();
        $class_arms = \App\Models\Class_arm::all();
        $terms = Term::all();
        $academic_sessions = AcademicSession::all();
        
        $student->load(['classes', 'class_arm','term', 'academicsessions']);
        return view('students.edit', compact('student', 'classes', 'class_arms', 'terms', 'academic_sessions'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //

        $validated = $request->validated();
        // DB::transaction(function() use($validated, $student){
            $student->update($validated);

        // });

        return back()->with('success', 'Student updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
