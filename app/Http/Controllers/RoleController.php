<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:view role permission',['only'=>['index']]);
        // $this->middleware('permission:create role permission',['only'=>['create','store']]);
        // $this->middleware('permission:delete role permission',['only'=>['destroy']]);
        // $this->middleware('permission:edit role permission',['only'=>['edit','update']]);
        // $this->middleware('permission:give-permission-to-role',['only'=>['AddPermissionToRole','GivePermissionToRole']]);
    }

    public function index()
    {
        $roles = Role::orderBy('name','ASC')->get();
        return view('role.index',compact('roles'));
    }
    public function create()
    {
        return view('role.create');
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
            
        $role = new Role;
        $role->name = $request->name;
        $role->save();
        
        return redirect('roles')->with('success','role created successfully');
    }
    public function edit($id)
    {
            $role = Role::find($id);
            return view('role.edit',compact('role'));

    }
    public function update($id,Request $request)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        return redirect('roles')->with('success','role Updated successfully');
    }
    public function destroy($id)
    {
        Role::find($id)->forceDelete();
        return redirect('roles')->with('success','role deleted successfully');
    }

    public function AddPermissionToRole($id)
    {
        $permissions = Permission::orderBy('name','ASC')->get();
        $role = Role::find($id);
        $role_permissions = DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id','=',$role->id)
                            ->pluck('role_has_permissions.permission_id')
                            ->all();
        
        return view('role.add_permissions',compact('role','permissions','role_permissions'));
    }
    public function GivePermissionToRole($id,Request $request)
    {
        $request->validate([
            'permission' =>'required',

            ]);

        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);

        return redirect('/roles')->with('success','permission Added to role');
    }

}
