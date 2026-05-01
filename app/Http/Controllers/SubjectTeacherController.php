<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classes;
use App\Models\Class_arm;

use App\Models\Subject;
use App\Models\SubjectTeacher;
use App\Http\Requests\Storesubject_teacherRequest;
use App\Http\Requests\Updatesubject_teacherRequest;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subjects = Subject::all();
        $classes = Classes::all();
        $classarms = Class_arm::all();
        $teachers = User::role(['teacher', 'admin'])->with('subjects','classes','classarms')->get();
        

        return view('subject_teachers.index', compact('teachers', 'subjects','classarms','classes'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $teachers = User::role(['teacher','admin'])->get();
        $subjects = Subject::all();
        $classes = Classes::all();
        $classarms = Class_arm::all();
        return view('subject_teachers.create', compact('teachers', 'subjects','classes','classarms'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storesubject_teacherRequest $request)
    {
        //
  
        $validated = $request->validated();
        // SubjectTeacher::where('teacher_id', $validated['teacher_id'])->delete();
  
        foreach ($validated['subject_ids'] as $subjectId){
            SubjectTeacher::create([
                'teacher_id' => $validated['teacher_id'],
                'classarm_id' => $validated['classarm_id'],
                'class_id' => $validated['class_id'],
                'subject_id' => $subjectId,

            ]);
        }
        //     dump($validated);
        // die;
        return redirect()->back()->with("success", "Subject allocated suucessfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(subject_teacher $subject_teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subject_teacher $subject_teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatesubject_teacherRequest $request, subject_teacher $subject_teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subject_teacher $subject_teacher)
    {
        //
    }
}
