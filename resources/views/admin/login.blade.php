@extends('layouts.app')

@section('content')
    <div class="mx-auto w-10/12">
        <div class="mx-auto bg-white w-4/12 rounded-lg flex-col">
            <div class="w-full h-40 bg-gradient-to-r from-sky-500 to-indigo-500 overflow-hidden rounded-t-lg flex justify-center items-center">
                {{-- <img src="{{ asset('images/bk.jpg') }}" alt=""> --}}
                <img src="{{ asset('images/bk.jpg') }}" alt="" class="w-24 h-24 rounded-full border-slate-500">
            </div>
            <div class="p-2 text-gray-700">
                <form action="{{ route('home') }}" method="POST">
                    @csrf
                    <div class="w-full p-1">
                        <label for="email"></label>
                        <input type="text" id="email" name="email" placeholder="Enter Email"
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('email')
                        border-red-500 @enderror" value="{{ old('email') }}">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="w-full p-1">
                        <label for="password"></label>
                        <input type="password" id="passowrd" name="password" placeholder="Enter Password" 
                        class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('password')
                        border-red-500 @enderror">

                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <label>
                        <input type="checkbox" name="remember" class="my-3 mx-2 text-gray-500"> Remember me
                    </label>
                    <button type="submit" class="w-full px-4 py-3 bg-blue-700 rounded-lg text-white">Login</button>
                </form>                
            </div>
        </div>
    </div>
@endsection