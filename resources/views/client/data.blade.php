@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Clients
                @if (auth()->user()->hasPermissionTo('Create Clients'))
                    <a href="{{ route('create-client') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                        Create New Client
                    </a>
                @endif
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="mt-6">
                <table class>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Unique No</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @if (!$clients->count())
                            <tr>
                                <td colspan="6" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td>{{ $client->unique_no }}</td>
                                <td>{{ $client->mobile }}</td>
                                <td>{{ $client->email }}</td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $client->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$client->id; ?>" class="dropdown-content">
                                        @if (auth()->user()->hasPermissionTo('View Clients'))
                                            <a href="{{ route('show-client', $client) }}">View</a>
                                        @endif
                                        @if (auth()->user()->hasPermissionTo('Edit Clients'))
                                            <a href="{{ route('edit-client', $client) }}">Edit</a>
                                        @endif
                                        @if (auth()->user()->hasPermissionTo('Delete Clients'))
                                            <form action="{{ route('delete-client', $client) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-record" onclick="return confirm('Are you sure?')">Delete</a>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection