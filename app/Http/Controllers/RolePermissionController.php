<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        return view("roles_permissions.index", compact("roles", "permissions"));
    }



public function getRolePermissions($roleId){
    $role = Role::findOrFail($roleId);
    $permissions = $role->permissions->pluck('name');
    return response()->json([
        'permissions' => $permissions 
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         $roles = Role::all();
        $permissions = Permission::all();
        return view("roles_permissions.create", compact("roles", "permissions"));
    }
    public function storeRole(Request $request){
        $request->validate([
            'role_name' =>'required|unique:roles,name'
        ]);
        Role::create(['name' => $request-> role_name]);
        
        return back()->with('success', 'Role created successfully!');


    }


    public function storePermission(Request $request){
        $request->validate([
            'permission_name' =>'required|unique:permissions,name'
        ]);
        Permission::create(['name' => $request-> permission_name]);
        
        return back()->with('success', 'Permission created successfully!');


    }

    
    public function assignPermission(Request $request){
        $request->validate([
            'role_id' => 'required|exists:roles,id',            
            'permission_ids' =>'required|array',
            'permission_ids.*' =>'exists:permissions,id'
        ]);
        $role = Role::find($request->role_id);
        $permission  = Permission::whereIn('name', $request->permission_ids)->get();

        $role->givePermissionTo($permission);

        return back()->with('success', 'Permissions assigned successfully!');


    }


    public function revokePermission(Request $request){
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists,permission,id'
        ]);
        $role = Role::find($request->role_id);
        $permission = Permission::whereIn('name', $request->permission_ids)->get();
        
        $role->revokePermissionTo($permission);

        return back()->with('success', 'Permissions remove from role');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
