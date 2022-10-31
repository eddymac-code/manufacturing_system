@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between p-2">
                Details - {{ $role->name }}
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold rounded-lg mb-2">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="flex justify-end">
                <a href="{{ route('assign_permissions', $role) }}" 
                class="bg-blue-500 text-white px-4 py-3 rounded-lg">
                    Assign Permissions
                </a>
            </div>
            <div class="p-2 text-gray-700">
                <div class="bg-white text-blue-600 w-full rounded-lg mb-4 p-2">
                    @if (!$role->permissions->count())
                        <p>{{ $role->name }} has no permissions granted yet</p>
                    @else
                        <div>
                            <p>{{ $role->name }} has {{ $role->permissions->count() }} 
                                {{ str()->plural('permission', $role->permissions->count()) }}</p>
                        </div>
                        <div class="mt-6">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($role->permissions as $data)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->slug }}</td>
                                            <td>
                                                <form action="{{ route('detach-permission', $data->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                    <button type="submit" class="bg-red-500 text-white px-3 py-2" 
                                                    onclick="return confirm('Are you sure?')">-</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>                
            </div>
        </div>
    </div>
@endsection