@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto bg-gray-300 rounded-lg w-8/12 py-1">
        <div class="flex align-center justify-between w-full p-4">
            <h2 class="text-blue-900 font-extrabold text-xl">Category: {{ $category->name }}</h2>
            <a href="{{ route('dashboard') }}" 
            class="bg-gray-600 text-white font-bold px-4 py-2 rounded-lg">Go Back</a>
        </div>

        <div class="mb-4 px-4 flex items-center space-x-6">
            @if ($category->image)
                <div class="shrink-0">
                    <img class="h-48 w-48 object-cover rounded-full border border-blue-900" src="{{ asset('storage/images/product_category/'.$category->image) }}"
                     alt="Current category photo" />
                </div>
            @endif
            <div class="">
                <p class="font-extrabold text-blue-900 text-xl">Name: {{ $category->name }}</p>
                <p class="font-extrabold text-blue-900 text-xl">Description: {{ $category->description }}</p>
                <p class="font-extrabold text-blue-900 text-xl">Status: {{ Str::ucfirst($category->status) }}</p>
            </div>
        </div>
    </div>
@endsection