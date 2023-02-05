@extends('layouts.guest')

@section('content')
    <div class="mx-auto w-10/12">
        <div class="mx-auto bg-white w-4/12 rounded-lg flex-col shadow-2xl">
            <div class="w-full h-40 bg-gradient-to-r from-sky-500 to-indigo-500 overflow-hidden rounded-t-lg flex justify-center items-center">
                {{-- <img src="{{ asset('images/bk.jpg') }}" alt=""> --}}
                <img src="{{ asset('images/bk.jpg') }}" alt="" class="w-24 h-24 rounded-full border-slate-500">
            </div>
            <div class="p-2 text-gray-700">
                {{ $error }}                
            </div>
        </div>
    </div>
@endsection