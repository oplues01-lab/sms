<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $staffs = Staff::with(['user'])->get();

        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      $users =  \App\Models\User::all();
      return view('staff.create', compact('users'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        //
        $validated =  $request->validated();
        DB::transaction(function () use ($validated) {

        $user = User::findOrFail($validated['user_id']);
        $user->syncRoles([$validated['role']]);

        Staff::create($validated);
        });

        return redirect()->route('staff.index')->with('success', 'Staff created successfully');
    }
 
    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
         $staff->load('user');
        return view('staff.show', compact('staff'));

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
        $users = User::all();
        $staff->load('user');

        return view('staff.edit', compact('users', 'staff'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $validated = $request->validated();
        DB::transaction(function() use ($validated, $staff){
            $staff->update($validated);
            $user = User::findOrFail($validated['user_id']);
            $user->syncRoles([$validated['role']]);
        });

        return redirect()->route('staff.show', $staff->id)->with('success', 'Staff updated successfully');


    }

    public function deactivate($id){
             

        $staff = Staff::find($id);
// dump($staff);
//         die;
        if(!$staff){
            abort(404);
        }
        $staff->update(['status' => 0]);



        return back()->with('success', 'Staff deactivated successfully');
        
    }

    public function activate($id){
   
        $staff = Staff::find($id);
        if(!$staff){
            abort(404);
        }

        $staff->update(['status' =>1]);

        return redirect()->back()->with('success', 'staff updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }




    public function idCard($id, $side)
{
    $staff = Staff::with('user')->findOrFail($id);

    if (!in_array($side, ['front', 'back'])) {
        abort(404);
    }

    return view('staff.id_card', compact('staff', 'side'));
}

}
