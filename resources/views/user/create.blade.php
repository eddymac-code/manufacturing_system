@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                <h2>Create New User</h2>  
            </div>
            <div class="p-2 text-gray-700">
                <form action="{{ route('create-user') }}" method="post">
                    @csrf
                    <div class="w-full p-1">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('name')
                        border-red-500 @enderror" value="{{ old('name') }}">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="email" class="sr-only">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter Email" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('email')
                        border-red-500 @enderror" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="address" class="sr-only">Address</label>
                        <input type="address" name="address" id="address" placeholder="Address here.." 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('address')
                        border-red-500 @enderror">
                        
                        @error('address')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="dob" class="sr-only">Date of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="Date of birth" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('dob')
                        border-red-500 @enderror">
                        
                        @error('dob')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password here.." 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('password')
                        border-red-500 @enderror">
                        
                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection