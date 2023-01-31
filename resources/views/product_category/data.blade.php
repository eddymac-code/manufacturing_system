@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Categories
                <a href="{{ route('create-category') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Create New Category
                </a>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="mt-6">
                <table class>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @if (!$data->count())
                            <tr>
                                <td colspan="5" class="text-center">No data available from table</td>
                            </tr>
                        @else
                        @foreach ($data as $category)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="shrink-0">
                                        <img class="h-16 w-16 object-cover rounded-full" 
                                        src="{{ asset('storage/images/product_category/'.$category->image) }}" 
                                        alt="Current category image" />
                                    </div>
                                </td>
                                <td>
                                    @if ($category->status == 'inactive')
                                        <span 
                                        class="font-bold bg-red-800 text-white text-center px-4 py-2 rounded-lg">
                                            {{ Str::upper($category->status) }}
                                        </span>
                                    @else
                                        <span 
                                        class="font-bold bg-green-800 text-white text-center px-4 py-2 rounded-lg">
                                            {{ Str::upper($category->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $category->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$category->id; ?>" class="dropdown-content">
                                        <a href="{{ route('show-category', $category) }}">View</a>
                                        <a href="{{ route('edit-category', $category) }}">Edit</a>
                                        <form action="{{ route('delete-category', $category) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-record" onclick="return confirm('Are you sure?')">Delete</a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                       {{ $data->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection