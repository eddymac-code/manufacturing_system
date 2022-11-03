<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
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
        return view('client.create');
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
        if ($request->hasFile('photo')) {
            $destination_path = 'public/images/clients/photos';
            $photo = $request->file('photo');
            $photo_name = $request->first_name . " (" . $request->unique_no . ") - " . $photo->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $photo_name);

            $data['photo'] = $photo_name;
        }

        if ($request->hasFile('files')) {
            $destination_path = 'public/images/clients/files';
            $files = $request->file('files');
            $files_name = $request->first_name . " (" . $request->unique_no . ") - " . $files->getClientOriginalName();
            $path = $request->file('files')->storeAs($destination_path, $files_name);

            $data['files'] = $files_name;
        }

        $request->user()->clients()->create($data);
        return back()->with('success', 'Client added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
