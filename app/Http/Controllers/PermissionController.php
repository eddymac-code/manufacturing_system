<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }
    
    public function index()
    {
        $data = [];
        $permissions = Permission::where('parent_id', 0)->get();
        foreach ($permissions as $permission) {
            array_push($data, $permission);
            $subs = Permission::where('parent_id', $permission->id)->get();
            foreach ($subs as $sub) {
                array_push($data, $sub);
            }
        }

        return view('user.permission.data', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $parent_permission = Permission::where('parent_id', 0)->get();
        
        
        return view('user.permission.create', [
            'parent_permission' => $parent_permission
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->parent_id = $request->parent_id;
        $permission->description = $request->description;
        $permission->slug = str()->snake($request->name);
        // str_slug($request->name, '_');
        $permission->save();

        return redirect()->route('permissions')->with('success', 'Permission Successfully added.');
    }

    public function edit(Permission $permission)
    {
        $parent_permission = Permission::where('parent_id', 0)->get();
        
        if ($permission->parent_id == 0) {
            $selected = 0;
        } else {
            $selected = 1;
        }
        return view ('user.permission.edit', [
            'permission' => $permission,
            'parent_permission' => $parent_permission,
            'selected' => $selected
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
            'parent_id' => $request->parent_id,
            'description' => $request->description,
            'slug' => str()->snake($request->name)
        ]);

        return redirect()->route('permissions')->with('success', 'Permission successfully updated.');

    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Permission successfully deleted');
    }
}
