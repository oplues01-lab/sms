<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = Classes::all();

        return view("classes.index", compact('classes'));

        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
     return view("classes.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassesRequest $request)
    {
        //
        $validated = $request->validated();
        Classes::create($validated);
        // return back()->with('success', 'Class created successfully');

        return redirect()->route('classes.index')->with('success', 'Class created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $class)
    {
        //
        return view('classes.edit', compact('class'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassesRequest $request, Classes $class)
    {
        //

        $validated = $request->validated();
        $class->updated($validated);

        return back()->with('success', 'Class updated successfully');
    }

 public function deactivate($id){

        $classes = Classes::find($id);

        if(!$classes){
            abort(404);
        }

        $classes->update(['status' =>0]);
        
        return back()->with('success', 'Class deactivated successfully');

    }

    

    public function activate($id){

        $classes = Classes::find($id);
        if(!$classes){
            abort(404);

        }

        $classes->update(['status' =>1]);
        
        return back()->with('success', 'Class activated successfully');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
