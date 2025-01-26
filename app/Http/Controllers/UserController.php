<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name')->all();
        return view('user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|email|max:255|unique:users,email',
            'password' =>'required|string|min:8|max:20',
            'roles' =>'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make(($request->password));
        $user->save();
        $user->syncRoles($request->roles);

        return redirect('/users')->with('success','user created successfully with roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $roles = Role::pluck('name')->all();
        $user = User::find($id);
        $user_roles = $user->roles->pluck('name')->all();
        return view('user.edit',compact('user','roles','user_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            //'email' =>'required|email|max:255|unique:users,email',
            'password' =>'nullable|string|min:8|max:20',
            'roles' =>'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password =  Hash::make(($request->password));
        }
        $user->save();
        $user->syncRoles($request->roles);

        return redirect('/users')->with('success','user Updated successfully with roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id)->forceDelete();
        return redirect('users')->with('success','user deleted successfully');
    }
}
