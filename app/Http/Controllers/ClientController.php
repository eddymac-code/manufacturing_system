<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(15);
        return view('client.data', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('Create Users')) {
            $message = "Permission Denied. Contact System Administrator";
            return redirect()->back()->with('warning', $message);
        }

        $max = Client::max('id');
        if ($max != '') {
            $max = Client::findOrFail($max);
            $max = $max->unique_no;
        } else {
            $max = "000";
        }

        $unique = intval(preg_replace("/[^0-9]/", "", $max));
        $unique = "MN".(sprintf('%03s', $unique+1));
        $users = User::all();
        $user = [];
        foreach ($users as $key) {
            $user[$key->id] = $key->name;
        }

        return view('client.create', [
            'user' => $user,
            'unique' => $unique
        ]);
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
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'email:rfc'
        ]);

        $data = $request->all();
        $data['branch_id'] = session('branch_id');
        if ($request->hasFile('photo')) {
            $destination_path = 'public/images/clients/photos';
            $photo = $request->file('photo');
            $photo_name = $request->unique_no . "-" . $photo->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $photo_name);

            $data['photo'] = $photo_name;
        }

        if ($request->hasFile('files')) {
            $destination_path = 'public/images/clients/files';
            $files = $request->file('files');
            $files_name = $request->unique_no . "-" . $files->getClientOriginalName();
            $path = $request->file('files')->storeAs($destination_path, $files_name);

            $data['files'] = $files_name;
        }

        $request->user()->clients()->create($data);
        return redirect()->route('clients')->with('success', 'Client added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        // dd($client->photo);
        return view('client.show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    { 
        $this->validate($request, [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'email:rfc'
        ]);

        $data = $request->except('_token', '_method');
        if ($request->hasFile('photo')) {
            if ($client->photo) {
                Storage::delete($client->photo);
            }
            $destination_path = 'public/images/clients/photos';
            $photo = $request->file('photo');
            $photo_name = $request->unique_no . "-" . $photo->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $photo_name);

            $data['photo'] = $photo_name;
        }

        if ($request->hasFile('files')) {
            if ($client->files) {
                Storage::delete($client->files);
            }
            $destination_path = 'public/images/clients/files';
            $files = $request->file('files');
            $files_name = $request->unique_no . "-" . $files->getClientOriginalName();
            $path = $request->file('files')->storeAs($destination_path, $files_name);

            $data['files'] = $files_name;
        }

        $request->user()->clients()->update($data);
        return redirect()->route('clients')->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients')->with('success', 'Deleted Successfully');
    }
}
