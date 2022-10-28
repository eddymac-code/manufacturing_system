@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Roles
                <a href="{{ route('create-role') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Create New Role
                </a>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold rounded-lg">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="mt-6">
                <table class>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @if ($roles->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $role->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$role->id; ?>" class="dropdown-content">
                                        <a href="{{ route('show-role', $role) }}">Details</a>
                                        <a href="{{ route('edit-role', $role) }}">Edit</a>
                                        <form action="{{ route('delete-role', $role) }}" method="post">
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