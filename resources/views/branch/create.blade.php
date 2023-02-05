@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Create Branch
            </div>
            <div class="p-2 text-gray-700">
                <form action="{{ route('create-branch') }}" method="post">
                    @csrf
                    <div class="w-full p-1">
                        <label for="name"></label>
                        <input type="text" name="name" id="name" placeholder="Enter Branch Name" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('name')
                        border-red-500 @enderror" value="{{ old('name') }}">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="description" class="sr-only">Description</label>
                        <textarea name="description" id="description" rows="3" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('description')
                        border-red-500 @enderror">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg">Add Branch</button>
                </form>
            </div>
        </div>
    </div>
@endsection