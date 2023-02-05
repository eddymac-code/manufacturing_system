@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Settings
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-5 py-4 rounded-lg">
                    Go Back
                </a>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="mt-6">
            <form method="post" action="{{ route('update-settings') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <div>
                <button class="bg-blue-500 text-white float-left outline-none cursor-pointer px-4 py-3 font-bold w-4/12 hover:bg-blue-900" 
                onclick="openTab('gen', this)">General</button>
                <button class="bg-blue-500 text-white float-left outline-none cursor-pointer px-4 py-3 font-bold w-4/12 hover:bg-blue-900" 
                onclick="openTab('pay', this)">Payment</button>
                <button class="bg-blue-500 text-white float-left outline-none cursor-pointer px-4 py-3 font-bold w-4/12 hover:bg-blue-900" 
                onclick="openTab('other', this)">Others</button>
                </div> --}}
                <div id="gen">
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="company_name" class="sr-only">Company Name</label>
                            <input type="text" name="company_name" id="company_name" placeholder="Enter Company Name" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('email')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_name')->first()->setting_value }}">
    
                            @error('company_name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1">
                            <label for="company_country" class="sr-only">Company Country</label>
                            <input type="text" name="company_country" id="company_country" placeholder="Enter Company Country" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_country')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_country')->first()->setting_value }}">
    
                            @error('company_country')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="company_address" class="sr-only">Company Address</label>
                            <input type="text" name="company_address" id="company_address" placeholder="Enter Company Address" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_address')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_address')->first()->setting_value }}">
    
                            @error('company_address')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1">
                            <label for="company_city" class="sr-only">Company City</label>
                            <input type="text" name="company_city" id="company_city" placeholder="Enter Company City" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_city')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_city')->first()->setting_value }}">
    
                            @error('company_city')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="company_zip" class="sr-only">Company Zip Code</label>
                            <input type="text" name="company_zip" id="company_zip" placeholder="Enter Company Zip Code" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_zip')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_zip')->first()->setting_value }}">
    
                            @error('company_zip')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1">
                            <label for="company_email" class="sr-only">Company Email</label>
                            <input type="text" name="company_email" id="company_email" placeholder="Enter Company Email" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_email')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_email')->first()->setting_value }}">
    
                            @error('company_email')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="company_website" class="sr-only">Company Website</label>
                            <input type="text" name="company_website" id="company_website" placeholder="Enter Company Website" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_website')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_website')->first()->setting_value }}">
    
                            @error('company_website')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1">
                            <label for="company_pin" class="sr-only">Company Pin</label>
                            <input type="text" name="company_pin" id="company_pin" placeholder="Enter Company Pin" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_pin')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_pin')->first()->setting_value }}">
    
                            @error('company_pin')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="company_currency" class="sr-only">Company Currency</label>
                            <input type="text" name="company_currency" id="company_currency" placeholder="Enter Company Currency" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_currency')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'company_currency')->first()->setting_value }}">
    
                            @error('company_currency')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1">
                            <label for="currency_symbol" class="sr-only">Currency Symbol</label>
                            <input type="text" name="currency_symbol" id="currency_symbol" placeholder="Enter Currency Symbol" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('currency_symbol')
                            border-red-500 @enderror" 
                            value="{{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}">
    
                            @error('currency_symbol')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-row">
                        <div class="w-full p-1">
                            <label for="currency_position" class="sr-only">Currency Position</label>
                            <select name="currency_position" id="currency_position" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('currency_position')
                                border-red-500 @enderror">
                                    <option value="">-- Select Currency Position --</option>
                                    <option value="left" @if(\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left') selected @endif>
                                        Left
                                    </option>
                                    <option value="right" @if(\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'right') selected @endif>
                                        Right
                                    </option>
                                </select>
    
                            @error('currency_position')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full p-1 overflow-hidden flex-wrap items-center space-x-6">
                            <label for="company_logo" class="sr-only">Company Logo</label>
                            <input type="file" name="company_logo" id="company_logo" 
                            class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('company_logo')
                            border-red-500 @enderror" value="{{ old('company_country') }}">
                            <div class="shrink-0">
                                <img class="h-16 w-16 object-cover rounded-full" 
                                src="{{ asset('storage/images/'.\App\Models\Setting::where('setting_key', 'company_logo')->first()->setting_value) }}" 
                                alt="Current company logo" />
                            </div>
    
                            @error('company_logo')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- <div id="pay">
                    <div class="w-full bg-blue-900 text-white font-bold rounded-lg px-5 py-3">
                        Payments
                    </div>                    
                </div>
                <div id="other">
                    <div class="w-full bg-blue-900 text-white font-bold rounded-lg px-5 py-3">
                        Others
                    </div>                    
                </div> --}}
                <input type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg" value="Save">
            </form>
            </div>
        </div>
    </div>
@endsection