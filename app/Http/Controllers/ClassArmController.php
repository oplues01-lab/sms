<?php

namespace App\Http\Controllers;

use App\Models\Class_arm;
use App\Http\Requests\StoreClass_armRequest;
use App\Http\Requests\UpdateClass_armRequest;

class ClassArmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classarms = Class_arm::all();
                return view('classarms.index', compact('classarms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("classarms.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClass_armRequest $request)
    {
        //

        $validated = $request->validated();
        Class_arm::create($validated);
        return redirect()->route('classarms.index')->with('success', 'Classarm created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Class_arm $class_arm)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Class_arm $classarm)
{
    return view('classarms.edit', compact('classarm'));
}

public function update(UpdateClass_armRequest $request, Class_arm $classarm)
{
    $validated = $request->validated();
    $classarm->update($validated);

    return back()->with('success', 'Class arm updated successfully');
}

    public function deactivate($id){

        $classarm = Class_arm::find($id);

        // dump($classarm); die;
        if(!$classarm){
            abort(404);
        }

        $classarm->update(['status' =>0]);
        
        return back()->with('success', 'Classarm deactivated successfully');

    }

    

    public function activate($id){

        $classarm = Class_arm::find($id);
        if(!$classarm){
            abort(404);

        }

        $classarm->update(['status' =>1]);
        
        return back()->with('success', 'Classarm activated successfully');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Class_arm $class_arm)
    {
        //
    }
}
