<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
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
}
