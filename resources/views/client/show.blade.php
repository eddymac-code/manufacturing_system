@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Client {{ $client->unique_no }}
                @if (auth()->user()->hasPermissionTo('Create Clients'))
                    <a href="{{ route('clients') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg mb-1">
                        Go Back
                    </a>
                @endif
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="flex flex-row justify-between">
                <div class="p-2 w-4/12 bg-white shadow-md">
                    <div class="flex justify-center">
                        <img src="{{ asset('/storage/images/clients/photos/'. $client->photo) }}" alt="client" 
                        class="w-40 h-40 border-2 border-blue-600 rounded-full">                        
                    </div>

                    {{-- Description --}}
                    <div class="p-3 text-gray-700 font-bold">
                        <p>Name: {{ $client->title ?? '' }}. {{ $client->first_name }} {{ $client->last_name }}</p>
                        <p>Age: {{ date('Y') - date('Y', strtotime($client->dob)) }}</p>
                        <p>Email: {{ $client->email }}</p>
                        <p>Mobile: {{ $client->mobile }}</p>
                        <p>Address: {{ $client->address }}, {{ $client->city }} {{ $client->post_code }}</p>
                    </div>

                    {{-- Statement --}}
                    <div class="p-3 mt-2">
                        <a class="text-blue-500 font-bold" href=""><i class="fa fa-bars"></i> Client Statement</a>
                    </div>
                </div>
                <div class="p-2 w-7/12 bg-white shadow-md">

                </div>
            </div>
        </div>
    </div>
@endsection