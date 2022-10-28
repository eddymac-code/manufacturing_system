@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                <h2>{{ $show_user->name }} ({{ $show_user->role->name ?? 'Unassigned' }})</h2>
                <a href="{{ route('users') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Go Back
                </a>
            </div>
            <div class="mt-6">
                <div>
                    <p>Name</p>
                    <p>Role</p>
                    @if (!$show_user->role)
                        <a href="{{ route('assign-role', $show_user) }}">
                            Assign Role
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection