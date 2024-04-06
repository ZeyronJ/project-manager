<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    function dashboard(){
        $projects = Project::all();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'inspector de obra');
            }
        )->get();

        return view('admin.dashboard', compact('projects','users'));
    }

    function users(){
        $users = User::all();
        return view('admin.user_views.index', compact('users'));
    }

    function roles(){
        $roles = Role::all();
        return view('admin.role_views.index', compact('roles'));
    }

    //Users and Roles

    public function user_add()
    {
        $roles = Role::all();
        return view('admin.user_views.add_user', compact('roles'));
    }

    public function user_adding(Request $request)
    {

        $request->name = ucfirst($request->name);

        $request->validate([
            'name' => 'required|unique:users|max:50',            
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|min:8'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $ids = $request->except('name','email','password','_token','_method');
        
        if($ids){
            foreach ($ids as $req) {
                $role = Role::find($req);

                if(!$user->hasRole($role)){
                    $user->assignRole($role);
                }
            }
        }

        return redirect()->route('admin.users')->with('success', 'Usuario agregado correctamente');
    }


    public function user_edit($userid)
    {        
        $user = User::find($userid);
        $roles = Role::all();

        return view('admin.user_views.edit_user', compact('user','roles'));
    }

    public function user_editing(Request $request,$userid)
    {
        $request->name = ucfirst($request->name);
        
        $request->validate([
            'name' => 'required|max:255|unique:users,name,'. $userid ,
            'email' => 'required|max:255|unique:users,email,'. $userid,

        ]);
        
        if($request->password){
            $request->validate([
                'password' => 'min:8'
            ]);
        }
        
        $user = User::find($userid);
        
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }
        
        $ids = $request->except('name','email','password','_token','_method');

        $user->syncRoles();

        if($user->id == 1){
            $user->assignRole('Admin');
        }
        
        if($ids){
            foreach ($ids as $req) {
                $role = Role::find($req);

                if(!$user->hasRole($role)){
                    $user->assignRole($role);
                }
            }
        }
        $user->save();
        
        return redirect()->route('admin.users')->with('success', 'Usuario editado correctamente');
    }

    
    public function user_delete($userid)
    {
        if($userid == 1){
            return redirect()->route('admin.users')->with('danger', 'Administrador no se puede eliminar');
        }

        $user = User::find($userid);
        $user->delete();
        return redirect()->route('admin.users')->with('danger', 'Usuario eliminado correctamente');
    }

    //Roles and Permissions

    public function role_add()
    {
        $permissions = Permission::all();
        return view('admin.role_views.add_role', compact('permissions'));
    }

    public function role_adding(Request $request)
    {

        $request->name = ucfirst($request->name);
        
        $request->validate([
            'name' => 'required|unique:roles|max:255',           
        ]);

        $role = Role::create(['name' => $request->name]);
    

        $ids = $request->except('name','_token','_method');


        foreach ($ids as $req) {
            Permission::find($req)->assignRole($role);
        }
        
        return redirect()->route('admin.roles')->with('success', 'Rol agregado correctamente');
    }


    public function role_edit($roleid)
    {
        $role = Role::find($roleid);
        $permissions = Permission::all();

        return view('admin.role_views.edit_role', compact('role'), compact('permissions'));
    }

    public function role_editing(Request $request, $roleid)
    {   
        $request->name = ucfirst($request->name);

        $role = Role::find($roleid);

        $role->name = $request->name;


        $ids = $request->except('name','_token','_method');
    
        $role->syncPermissions();

        foreach ($ids as $req) {
            Permission::find($req)->assignRole($role);
        }
        
        $role->save();
        
        return redirect()->route('admin.roles')->with('success', 'Rol editado correctamente');
    }

    
    public function role_delete($roleid)
    {
        if($roleid == 1){
            return redirect()->route('admin.roles')->with('danger', 'Admin no se puede eliminar');
        }
        $role = Role::find($roleid);
        $role->delete();
        return redirect()->route('admin.roles')->with('danger', 'Rol eliminado correctamente');

    }
    
    //
}
