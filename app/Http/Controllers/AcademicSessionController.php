<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Http\Requests\StoreAcademicSessionRequest;
use App\Http\Requests\UpdateAcademicSessionRequest;

class AcademicSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $academic_sessions = AcademicSession::all();
    return view('academic_sessions.index', compact('academic_sessions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('academic_sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicSessionRequest $request)
    {
        //
         $validated = $request->validated();
        AcademicSession::create($validated);
        return back()->with('success', 'Session created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicSession $academicSession)
    {
        //
        return view('academic_sessions.show', compact('academicSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(AcademicSession $academicSession)
    {
        //
        return view('academic_sessions.edit', compact('academicSession'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicSessionRequest $request, AcademicSession $academicSession)
    {
        //
        $validated = $request->validated();
        $academicSession->update($validated);

        return back()->with('success', 'Academic session updated successfully');
    }




    public function deactivate($id){
        $academic_session = AcademicSession::find($id);
        if(!$academic_session){
            abort(404);

        }
        $academic_session->update(['status'=>0]);

        return back()->with('success', 'Session deactivated successfully');

    }
    public function activate($id){
        $academic_session = AcademicSession::find($id);
        if(!$academic_session){
            abort(404);

        }
        $academic_session->update(['status'=>1]);

        return back()->with('success', 'Session activated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicSession $academicSession)
    {
        //
    }
}
