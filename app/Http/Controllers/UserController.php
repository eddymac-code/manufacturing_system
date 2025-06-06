<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }
    
    public function index()
    {
        $users = User::all();

        return view('user.data', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc',
            'dob' => 'date',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address ?? "None Specified";
        $user->dob = $request->dob;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users')->with('success', 'User saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        
        $show_user = User::find($user);

        return view('user.show', [
            'show_user' => $show_user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function index_role($user)
    {
        $show_user = User::find($user);

        $roles = [];
        foreach (Role::all() as $key) {
            array_push($roles, $key);
        }
        
        return view('user.assign_role', [
            'show_user' => $show_user,
            'roles' => $roles
        ]);
    }
    
    public function assign_role(Request $request, $show_user)
    {
        $this->validate($request, [
            'role_id' => 'required'
        ]);
        
        $assignable = User::find($show_user);
        $role_id = $request->role_id;

        $assignable->assignRole($role_id);

        return redirect()->route('users')->with('success', 'Assigned role successfully');
    }
}
