<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(5);

        return view('user.permission.data', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('user.permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->slug = str()->snake($permission->name);
        $permission->save();

        return back()->with('success', 'Permission Successfully added.');
    }

    public function edit(Permission $permission)
    {
        return view ('user.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Permission $permission, Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        // $permission = Permission::find($permission->id);
        // $permission->name = $request->name;
        // $permission->slug = str()->snake($permission->name);
        // $permission->save();

        $permission->update([
            'name' => $request->name,
            'slug' => str()->snake($request->name)
        ]);

        return back()->with('success', 'Permission successfully updated.');

    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Permission successfully deleted');
    }
}
