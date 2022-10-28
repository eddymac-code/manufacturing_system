@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Users
                <a href="{{ route('create-user') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Create New User
                </a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @if (!$users)
                            <tr>
                                <td colspan="5" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role ?? 'No role assigned yet' }}</td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $user->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$user->id; ?>" class="dropdown-content">
                                        <a href="{{ route('show-user', $user) }}">View</a>
                                        <a href="{{ route('edit-user', $user) }}">Edit</a>
                                        <form action="{{ route('delete-user', $user) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-record" onclick="return confirm('Are you sure?')">Delete</a>
                                        </form>
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