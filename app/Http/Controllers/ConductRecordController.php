<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConductRecordRequest;
use App\Http\Requests\UpdateConductRecordRequest;
use App\Models\ConductRecord;
use App\Models\Student;
use App\Services\BehaviorService;

class ConductRecordController extends Controller
{
    public function __construct(private BehaviorService $behaviorService)
    {
        $this->middleware('can:manage-behavior');
    }

    public function index()
    {
        $records = ConductRecord::with(['student', 'recordedBy', 'term'])
            ->latest()
            ->paginate(20);

        return view('admin.behavior.conduct.index', compact('records'));
    }

    public function create()
    {
        $students = Student::with(['classes', 'class_arm'])
            ->orderBy('first_name')
            ->get();

        return view('admin.behavior.conduct.create', compact('students'));
    }

    public function store(StoreConductRecordRequest $request)
    {
        $conduct = $this->behaviorService->recordConduct($request->validated());

        return redirect()->route('admin.conduct.index')
            ->with('success', 'Conduct record created successfully');
    }

    public function show(ConductRecord $conduct)
    {
        $conduct->load(['student', 'recordedBy', 'term', 'academicSession']);
        
        return view('admin.behavior.conduct.show', compact('conduct'));
    }

    public function edit(ConductRecord $conduct)
    {
        $students = Student::with(['classes', 'class_arm'])
            ->orderBy('first_name')
            ->get();

        return view('admin.behavior.conduct.edit', compact('conduct', 'students'));
    }

    public function update(UpdateConductRecordRequest $request, ConductRecord $conduct)
    {
        $conduct->update($request->validated());

        return redirect()->route('admin.conduct.index')
            ->with('success', 'Conduct record updated successfully');
    }

    public function destroy(ConductRecord $conduct)
    {
        $this->authorize('delete', $conduct);
        
        $conduct->delete();

        return redirect()->route('admin.conduct.index')
            ->with('success', 'Conduct record deleted successfully');
    }
}