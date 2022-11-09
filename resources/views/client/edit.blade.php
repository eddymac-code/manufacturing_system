@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                <h2>Edit Client {{ $client->unique_no }}</h2>  
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="bg-red-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('warning') }}
                </div>
            @endif
            <div class="p-2 text-gray-700">
                <form action="{{ route('edit-client', $client) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mt-2">
                        <div class="p-2">
                            <h2 class="font-bold">Personal Details</h2>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="title" class="sr-only">Title</label>
                                <select name="title" id="title" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('title')
                                border-red-500 @enderror">
                                    <option value="">-- Select Title --</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Eng">Eng</option>
                                    <option value="Prof">Prof</option>
                                </select>
        
                                @error('title')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="first_name" class="sr-only">Name</label>
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('first_name')
                                border-red-500 @enderror" value="{{ $client->first_name }}">
    
                                @error('first_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('last_name')
                                border-red-500 @enderror" value="{{ $client->last_name }}">
    
                                @error('last_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="gender" class="sr-only">Gender</label>
                                <select name="gender" id="gender" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('gender')
                                border-red-500 @enderror">
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Neither">Neither</option>
                                </select>
        
                                @error('gender')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="unique_no" class="sr-only">Unique Number</label>
                                <input type="text" name="unique_no" id="unique_no" value="{{ $client->unique_no }}" readonly
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100">
                            </div>
                            <div class="w-full p-1">
                                <label for="mobile" class="sr-only">Mobile</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Mobile" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('mobile')
                                border-red-500 @enderror" value="{{ $client->mobile }}">
    
                                @error('mobile')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="email" class="sr-only">Email</label>
                                <input type="text" name="email" id="email" placeholder="Enter Email Address" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('email')
                                border-red-500 @enderror" value="{{ $client->email }}">
    
                                @error('email')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="work_phone" class="sr-only">Work Phone</label>
                                <input type="tel" name="work_phone" id="work_phone" placeholder="Work Phone" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('work_phone')
                                border-red-500 @enderror" value="{{ $client->work_phone }}">
    
                                @error('work_phone')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="dob" class="sr-only">Date of Birth</label>
                                <input type="date" name="dob" id="dob" placeholder="Date of birth" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('dob')
                                border-red-500 @enderror" value="{{ $client->dob }}">
                                
                                @error('dob')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="id_number" class="sr-only">ID / Passport Number</label>
                                <input type="text" name="id_number" id="id_number" placeholder="ID / Passport No" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('id_number')
                                border-red-500 @enderror" value="{{ $client->id_number }}">
                                
                                @error('id_number')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="country" class="sr-only">Country</label>
                                <input type="text" name="country" id="country" placeholder="Country" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('country')
                                border-red-500 @enderror" value="{{ $client->country }}">
                                
                                @error('country')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="address" class="sr-only">P.O Box</label>
                                <input type="" name="address" id="address" placeholder="P.O. Box" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('address')
                                border-red-500 @enderror" value="{{ $client->address }}">
                                
                                @error('address')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="city" class="sr-only">City</label>
                                <input type="text" name="city" id="city" placeholder="City" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('city')
                                border-red-500 @enderror" value="{{ $client->city }}">
                                
                                @error('city')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="post_code" class="sr-only">Post Code / Zip</label>
                                <input type="text" name="post_code" id="post_code" placeholder="Post Code / Zip" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('post_code')
                                border-red-500 @enderror" value="{{ $client->post_code }}">
                                
                                @error('post_code')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1 overflow-hidden flex-wrap">
                                <label for="photo">Upload Photo</label>
                                <input type="file" name="photo" id="photo" class="p-2">
                            </div>
                            <div class="w-full p-1 overflow-hidden flex-wrap">
                                <label for="files">Upload Files</label>
                                <input type="file" name="files" id="files" class="p-2">
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="p-2">
                            <h2 class="font-bold">Business Details</h2>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-full p-1">
                                <label for="business_name" class="sr-only">Business Name</label>
                                <input type="text" name="business_name" id="business_name" placeholder="Business Name" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('business_name')
                                border-red-500 @enderror" value="{{ $client->business_name }}">
        
                                @error('business_name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="w-full p-1">
                                <label for="business_location" class="sr-only">Business Location</label>
                                <input type="text" name="business_location" id="business_location" placeholder="Business Location" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('business_location')
                                border-red-500 @enderror" value="{{ $client->business_location }}">
                                
                                @error('business_location')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <div class="w-6/12 p-1">
                                <label for="busineess_landmark" class="sr-only">Nearest Landmark</label>
                                <input type="text" name="business_landmark" id="business_landmark" placeholder="Nearest Landmark" 
                                class="w-full border-2 py-3 px-5 my-3 rounded-lg bg-gray-100 @error('business_landmark')
                                border-red-500 @enderror" value="{{ $client->business_landmark }}">
    
                                @error('business_landmark')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <button type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg">Create</button> --}}
                    <input type="submit" class="px-4 py-3 bg-blue-600 text-white rounded-lg" value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection