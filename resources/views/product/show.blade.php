@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto bg-gray-300 rounded-lg w-8/12 py-1">
        <div class="flex align-center justify-between w-full p-4">
            <h2 class="text-blue-900 font-extrabold text-xl">Category: {{ $product->name }}</h2>
            <a href="{{ route('dashboard') }}" 
            class="bg-gray-600 text-white font-bold px-4 py-2 rounded-lg">Go Back</a>
        </div>

        <div class="mb-4 px-4 flex items-center space-x-6">
            @if ($product->image)
                <div class="shrink-0">
                    <img class="h-48 w-48 object-cover rounded-full border border-blue-900" src="{{ asset('storage/images/product/'.$product->image) }}"
                     alt="Current product photo" />
                </div>
            @endif
            <div class="">
                <p class="font-extrabold text-blue-900 text-xl">Name: {{ $product->name }}</p>
                <p class="font-extrabold text-blue-900 text-xl">Description: {{ $product->description }}</p>
                <p class="font-extrabold text-blue-900 text-xl">
                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                        Price: {{ \App\Models\Setting::where('setting_key', 'company_currency')->first()->setting_value }} {{ number_format($product->price, 2) }}
                    @else
                        Price: {{ number_format($product->price, 2) }} {{ \App\Models\Setting::where('setting_key', 'currency')->first()->setting_value }}
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection