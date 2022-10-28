@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Permissions
                <a href="{{ route('create-permission') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Create New permission
                </a>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="mt-6">
                <table class="mb-4">
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
                        @if (!$permissions->count())
                            <tr>
                                <td colspan="4" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->slug }}</td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $permission->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$permission->id; ?>" class="dropdown-content">
                                        <a href="{{ route('show-permission', $permission) }}">Details</a>
                                        <a href="{{ route('edit-permission', $permission) }}">Edit</a>
                                        <form action="{{ route('delete-permission', $permission) }}" method="post">
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
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
@endsection