@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto bg-gray-300 rounded-lg w-4/12 py-1">
        <div class="flex align-center justify-between w-full p-4">
            <h2 class="text-blue-900 font-extrabold text-xl">Edit Product</h2>
            <a href="{{ route('dashboard') }}" 
            class="bg-gray-600 text-white font-bold px-4 py-2 rounded-lg">Go Back</a>
        </div>

        <form action="{{ route('edit-product', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4 px-4">
                <label for="category" class="text-blue-900 font-bold">Category</label>
                <select name="category" id="category" 
                class="bg-white text-black p-3 w-full rounded-lg border 
                @error('category') border-red-700 @endif">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" @if($item->id == $product->category_id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                </select>
    
                @error('category')
                    <div class="mt-2 text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4 px-4">
                <label for="name" class="text-blue-900 font-bold">Name</label>
                <input type="text" name="name" id="name" 
                class="bg-white text-black p-3 w-full rounded-lg border 
                @error('name') border-red-700 @endif" value="{{ $category->name }}">
    
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
                @error('description') border-red-700 @endif">{{ $category->description }}</textarea>
            </div>

            <div class="mb-4 px-4">
                <label for="price" class="text-blue-900 font-bold">Price</label>
                <input type="number" name="price" id="price" 
                class="bg-white text-black p-3 w-full rounded-lg border 
                @error('price') border-red-700 @endif" value="{{ $category->price }}">
    
                @error('price')
                    <div class="mt-2 text-red-500 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="mb-4 px-4">
                @if ($product->image)
                    <div class="shrink-0">
                        <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('storage/images/product_category/'.$product->image) }}"
                         alt="Current category photo" />
                    </div>
                @endif
                <label for="image" class="block">
                    <span class="sr-only">Choose Product Image</span>
                    <input type="file" name="image" id="image" class="block w-full text-black
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-400 file:text-gray-700
                    hover:file:bg-slate-600 hover:file:text-white
                    "/>
                </label>
            </div>
    
            <div class="flex justify-end px-4">
                <input type="submit" value="Update" class="text-white bg-blue-900 px-6 py-3 rounded-lg w-1/2">
            </div>
        </form>
    </div>
@endsection