<?php

namespace App\Http\Controllers;

use App\Models\Formteacher;
use App\Http\Requests\StoreFormteacherRequest;
use App\Http\Requests\UpdateFormteacherRequest;

class FormteacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $role = Role::whereIn('teacher')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormteacherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Formteacher $formteacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formteacher $formteacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormteacherRequest $request, Formteacher $formteacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formteacher $formteacher)
    {
        //
    }
}
