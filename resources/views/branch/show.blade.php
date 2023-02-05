@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Branch: {{ $branch->name }}
            </div>
            <div class="p-2 text-gray-700">
                This branch has {{ count($users) }} {{ Str::plural('user', count($users)) }}
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mt-6">
                <table class>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @if (count($users) == 0)
                            <tr>
                                <td colspan="4" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $user->user->name }}</td>
                                <td>{{ $user->user->email }}</td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $user->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$user->id; ?>" class="dropdown-content">
                                        <form action="{{ route('remove-branch-user', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="remove-record" onclick="return confirm('Are you sure?')">Remove</a>
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
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Add User to branch {{ $branch->name }}
            </div>
            <div class="p-2 text-gray-700">
                <form action="{{ route('add-branch-user', $branch->id) }}" method="post">
                    @csrf
                    <div class="w-full p-1">
                        <label for="user" class="sr-only">User</label>
                        <select name="user_id" id="user_id" class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('user_id')
                        border-red-500 @enderror">
                            <option value="">-- Select --</option>
                            @foreach ($branch_users as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg">Add User</button>
                </form>
            </div>
        </div>
    </div>
@endsection