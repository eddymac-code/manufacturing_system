<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\BranchUser;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }

    public function index()
    {
        $branches = Branch::all();

        return view('branch.data', [
            'branches' => $branches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branch.create');
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
            'name' => 'required'
        ]);

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->description = $request->description;
        $branch->save();

        $branch_user = new BranchUser();
        $branch_user->branch_id = $branch->id;
        $branch_user->user_id = 1;
        $branch_user->save();

        return redirect()->route('branches')->with('success', 'Branch added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);
        $users = $branch->users;
        $branch_users = [];
        foreach (User::all() as $key) {
            array_push($branch_users, $key);
        }
        
        return view('branch.show', [
            'branch' => $branch,
            'users' => $users,
            'branch_users' => $branch_users
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
        $branch = Branch::find($id);

        return view('branch.edit', [
            'branch' => $branch
        ]);
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->description = $request->description;
        $branch->save();

        return redirect()->route('branches')->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);

        $branch->delete();

        return redirect()->route('branches')->with('success', 'Branch deleted successfully');
    }

    public function change()
    {
        $branches = [];

        $branch_user = BranchUser::where('user_id', auth()->user()->id)->get();

        foreach ($branch_user as $key) {
            if (!empty($key->branch)) {
                array_push($branches, $key->branch);
            }
        }

        return view('branch.change', [
            'branches' => $branches
        ]);
    }

    public function persistChange(Request $request)
    {
        $request->session()->put('branch_id', $request->branch_id);

        return redirect('dashboard');
    }

    public function addUser(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        
        if (BranchUser::where('branch_id', $id)->where('user_id', $request->user_id)->count() > 0) {
            
            return redirect()->back()->with('error', 'User already added to branch.');
        }

        $branch_user = new BranchUser();
        $branch_user->branch_id = $id;
        $branch_user->user_id = $request->user_id;
        $branch_user->save();

        $message = "User successfully added to branch";
        return redirect()->back()->with($message);
    }

    public function removeUser($id)
    {
        $branch_user = BranchUser::find($id);
        
        if ($branch_user->user->id == 1) {
            return redirect()->back()->with('error', 'Cannot remove this user. The system requires them. Contact support.');
        }

        BranchUser::destroy($id);
        $message = "Removed successfully!";
        return redirect()->back()->with($message);
    }
}
