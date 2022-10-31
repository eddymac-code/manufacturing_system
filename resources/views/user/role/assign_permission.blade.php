@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between p-2">
                Assign Permissions to {{ $role->name }}
            </div>
            <div class="p-2 text-gray-700">
                <div class="bg-white text-blue-600 w-full rounded-lg mb-4 p-2">
                    @if (!count($permissions))
                        
                        <div class="flex justify-between p-2">
                            <div>
                                <p>No permissions to assign yet</p>
                            </div>
                            <div>
                            <a href="{{ route('create-permission') }}" 
                            class="bg-blue-500 text-white px-4 py-3 rounded-lg">
                                Create Permissions
                            </a>
                            </div>
                        </div>
                    @else
                        @error('permission_id')
                            <div class="bg-red-500 text-white px-4 py-3 rounded-lg">
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{ route('assign_permissions', $role) }}" method="post">
                            @csrf
                            <div class="w-full p-1">
                                @foreach ($permissions as $permission)
                                <div class="flex justify-between">
                                    <div class="flex justify-start w-6/12">
                                        <label for="permission_id"> {{ $permission->name }}</label>
                                    </div>
                                    <div class="flex justify-start w-6/12">
                                        <input type="checkbox" name="permission_id[]" id="" value="{{ $permission->id }}"><br>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                            <div class="w-full p-1 flex justify-end">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded-lg">
                                    Assign                                    
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
                
                
            </div>
        </div>
    </div>
@endsection