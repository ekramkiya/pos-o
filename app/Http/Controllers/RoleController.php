<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:role view',['only'=>['index']]);
        $this->middleware('permission:role create',['only'=>['create', 'show','store']]);
        $this->middleware('permission:role edit',['only'=>['edit']]);
        $this->middleware('permission:role update',['only'=>[ 'update', 'toupdate']]);
        $this->middleware('permission:role delete',['only'=>['destroy']]);

    }

    public function index()
    {

        return view('role.index')
            ->with('roles', Role::paginate(10));
    }

    public function create()
    {

        return view('role.create');
    }

    public function show(Role $role)
    {
        return view('role.show')
            ->with('permissions', Permission::all())
            ->with('role_id', $role);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::create(['name' => $request->name]);


        if (!$role->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating the user.');
        }

        return redirect()->route('role.index')->with('success', 'Success, the role has been created.');
    }

    public function edit(Role $role)
    {
            
        return view('role.edit')->with('role', $role);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role->name = $request['name'];

        if (!$role->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while updating the Role.');
        }

        return redirect()->route('role.index')->with('success', 'Success, the Role has been updated.');
    }


    public function toupdate(Request $request)
    {
        
        $request->validate([
            'role' => 'required',
            'permissions' => 'required|array',
        ]);
       
    
        $roleId = $request->input('role');
        $permissions = $request->input('permissions');
        
    
        $role = Role::find($roleId);
    
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found.');
        }
    
        $role->permissions()->sync($permissions);
    
        if (!$role->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while updating the permissions.');
        }
    
        return redirect()->route('role.index')->with('success', 'Success, the permissions have been updated.');
    }
    public function destroy(Role $role)
    {

        $role->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
