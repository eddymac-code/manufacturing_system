@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Change Branch
            </div>
            <div class="p-2 text-gray-700">
                <form action="{{ route('switch-branch') }}" method="post">
                    @csrf
                    <div class="w-full p-1">
                        <label for="branch_id" class="sr-only">Branch</label>
                        <select name="branch_id" id="branch" class="w-full border-2 py-3 px-5 my-3 rounded-lg">
                            <option value="">-- Select --</option>
                            @foreach ($branches as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection