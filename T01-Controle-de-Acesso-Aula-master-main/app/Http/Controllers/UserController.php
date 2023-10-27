<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }
    
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::find($request->user);
        $roles = $request->roles;

        $user->syncRoles($roles);
        
        return redirect()->route('roles.index');
    }

    public function show(User $user)
    {
        $roles = Role::all();

        return view('users.show', compact(['roles', 'user']));
    }

    public function edit($user){
    
    $user = User::find($user);

   
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $user){
  
    $request->validate([
        'password' => 'required|string|min:8|confirmed', 
    ]);

    
    $user = User::find($user);

   
       
        $user->password = Hash::make($request->password);
        $user->save();

        
        return view('dashboard');
    
    }

    public function destroy($id)
    {
        //
    }
}
