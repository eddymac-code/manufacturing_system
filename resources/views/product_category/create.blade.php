@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto bg-gray-300 rounded-lg w-4/12 py-1">
        <div class="flex align-center justify-between w-full p-4">
            <h2 class="text-blue-900 font-extrabold text-xl">Create Category</h2>
            <a href="{{ route('dashboard') }}" 
            class="bg-gray-600 text-white font-bold px-4 py-2 rounded-lg">Go Back</a>
        </div>

        <form action="{{ route('create-category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 px-4">
                <label for="name" class="text-blue-900 font-bold">Name</label>
                <input type="text" name="name" id="name" 
                class="bg-white text-black p-3 w-full rounded-lg border 
                @error('name') border-red-700 @endif" value="{{ old('name') }}">
    
                @error('name')
                    <div class="mt-2 text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="mb-4 px-4">
                <label for="description" class="text-blue-900 font-bold">Description</label>
                <textarea name="description" id="description" rows="3" 
                class="bg-white text-black p-3 w-full rounded-lg border 
                @error('description') border-red-700 @endif">{{ old('description') }}</textarea>
            </div>
    
            <div class="mb-4 px-4">
                <label for="image" class="block">
                    <span class="sr-only">Choose Category Image</span>
                    <input type="file" name="image" id="image" class="block w-full text-black
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-400 file:text-gray-700
                    hover:file:bg-slate-600 hover:file:text-white
                    "/>
                </label>
            </div>
    
            <div class="mb-4 px-4">
                <label class="text-blue-900 font-bold">
                    <input type="checkbox" name="status" id="status" class="accent-slate-600">
                    Active
                </label>
            </div>
    
            <div class="flex justify-end px-4">
                <input type="submit" value="Save" class="text-white bg-blue-900 px-6 py-3 rounded-lg w-1/2">
            </div>
        </form>
    </div>
@endsection