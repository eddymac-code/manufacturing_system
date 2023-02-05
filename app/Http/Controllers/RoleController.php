<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }
    
    public function index()
    {
        $roles = Role::all();

        return view('user.role.data', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('user.role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->slug = str()->snake($role->name);
        $role->save();

        return redirect()->route('roles')->with('success', 'Role Successfully added.');
    }

    public function show(Role $role)
    {
        return view('user.role.show', [
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        return view ('user.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        // $role = Role::find($role->id);
        // $role->name = $request->name;
        // $role->slug = str()->snake($role->name);
        // $role->save();

        $role->update([
            'name' => $request->name,
            'slug' => str()->snake($request->name)
        ]);

        return redirect()->route('roles')->with('success', 'Role successfully updated.');

    }

    public function destroy(Role $role, Request $request)
    {
        $role->delete();

        return back()->with('success', 'Role successfully deleted');
    }

    public function assign_permissions_index(Role $role)
    {
        $permissions = [];

        $p = Permission::all();

        foreach ($p as $key) {
            array_push($permissions, $key);
        }

        // dd($permissions);
        return view('user.role.assign_permission', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function assign_permissions_store(Request $request, Role $role)
    {
        $this->validate($request, [
            'permission_id' => 'required'
        ]);

        // dd($request->permission_id);
        $role->assignPermission($request->permission_id);

        return redirect()->route('show-role', $role->id)->with('success', "Permissions assigned successfully");
    }

    public function remove_permission(Request $request, $id)
    {
        $role = Role::find($request->role_id);
        
        $role->dropPermission($id);

        return back()->with('success', 'Permission detached successfully.');
    }
}
