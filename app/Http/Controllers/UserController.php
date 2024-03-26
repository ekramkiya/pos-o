<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;





class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employe update',['only'=>['edit', 'update']]);
        $this->middleware('permission:employe create',['only'=>['create', 'store']]);
        $this->middleware('permission:employe view',['only'=>['index']]);
        $this->middleware('permission:employe delete',['only'=>['destroy']]);

    }

    public function index(){
        $users = User::all();
        $roles = Role::all(); 
        return view('auth.index', compact('users','roles'));
    }

    public function create(){
        $roles = Role::all(); 
        return view('auth.create',compact('roles'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'user_role' =>  'nullable'
            
        ]);
    
        // Create a new user record
        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->user_role = $validatedData['user_role'];

        
        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while creating the user.');
        }
    
        return redirect()->route('employe.index')->with('success', 'Success, the user has been created.');
    }

    public function edit(User $user){
        $roles = Role::all(); 
        return view('auth.edit')
                        ->with('user', $user)
                        ->with('roles', $roles);

       
    }

   

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
            'user_role' => 'nullable'
        ]);
        
        // Update the user record
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->user_role = $validatedData['user_role'];
        
        // Only update the password if it's provided
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
        
        if (!$user->save()) {
            return redirect()->back()->with('error', 'Sorry, there was a problem while updating the user.');
        }
        
        return redirect()->route('employe.index')->with('success', 'Success, the user has been updated.');
    }
    public function destroy(User $user)
    {
        
        $user->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
