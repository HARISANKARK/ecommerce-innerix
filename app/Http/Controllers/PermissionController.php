<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('permission.index',compact('permissions'));
    }
    public function create()
    {
        return view('permission.create');
    }
    public function store(Request $request)
    {
        $request->validate([
                            'name' =>[
                                'required',
                                'string',
                                'unique:permissions,name',
                
                            ]
                        ]);
                        
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->save();
        
    return redirect('permissions')->with('success','permission created successfully');
    }
    public function edit($id)
    {
            $permission = Permission::find($id);
            return view('permission.edit',compact('permission'));

    }
    public function update($id,Request $request)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        return redirect('permissions')->with('success','permission Updated successfully');
    }
    public function destroy($id)
    {
        Permission::find($id)->forceDelete();
        return redirect('permissions')->with('success','permission deleted successfully');
    }

}
