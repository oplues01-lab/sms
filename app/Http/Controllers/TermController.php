<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\AcademicSession;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
                $terms = Term::all();

             return view("terms.index", compact("terms"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTermRequest $request)
    {
        //
        $validated = $request->validated();
        Term::create($validated);
        // return back()->with('success', 'Term created successfully');
         return redirect()->route('terms.index')->with('success', 'Term created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        //
        
        return view('terms.edit', compact('term'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTermRequest $request, Term $term)
    {
        //
        
        $validated = $request->validated();
        $term->updated($validated);

        return back()->with('success', 'Class updated successfully');
    }



    /**
     * Update the specified resource in storage.
     */

    public function deactivate($id){

        $term = Term::find($id);

        if(!$term){
            abort(404);
        }

        $term->update(['status' =>0]);
        
        return back()->with('success', 'Term deactivated successfully');

    }

    

    public function activate($id){

        $term = Term::find($id);
        if(!$term){
            abort(404);

        }

        $term->update(['status' =>1]);
        
        return back()->with('success', 'Term activated successfully');

    }















    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        //
    }
}
