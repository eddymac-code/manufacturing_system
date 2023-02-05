@extends('layouts.app')

@section('content')
    <div class="my-20 mx-auto w-10/12 p-4 h-auto bg-white rounded-lg">
        <div class="w-11/12 mx-auto mt-4 p-4 rounded-lg bg-gray-200 text-gray-900">
            <div class="font-bold flex justify-between">
                Products
                <a href="{{ route('create-product') }}" class="bg-sky-500 text-white px-5 py-4 rounded-lg">
                    Create New Product
                </a>
            </div>
            @if (session()->has('success'))
                <div class="bg-green-600 mt-2 px-3 py-5 text-white font-bold rounded-lg">
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
                            <th>Price</th>
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
                        @foreach ($data as $product)
                            <tr>
                                <td>{{ ++$i; }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <div class="shrink-0">
                                        <img class="h-16 w-16 object-cover rounded-full" 
                                        src="{{ asset('storage/images/product/'.$product->image) }}" 
                                        alt="Current product image" />
                                    </div>
                                </td>
                                <td>
                                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                                        {{ \App\Models\Setting::where('setting_key', 'company_currency')->first()->setting_value }} {{ number_format($product->price, 2) }}
                                    @else
                                        {{ number_format($product->price, 2) }} {{ \App\Models\Setting::where('setting_key', 'company_currency')->first()->setting_value }}
                                    @endif
                                </td>
                                <td>
                                    <i class="fa-solid fa-bars drop-button" onclick="expandmenu(<?php echo $product->id; ?>)"></i>
                                    <div id="<?php echo "myDrop".$product->id; ?>" class="dropdown-content">
                                        <a href="{{ route('show-product', $product) }}">View</a>
                                        <a href="{{ route('edit-product', $product) }}">Edit</a>
                                        <form action="{{ route('delete-product', $product) }}" method="post">
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