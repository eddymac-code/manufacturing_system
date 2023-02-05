<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'branch']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::where('branch_id', session('branch_id'))
                ->orderBy('created_at', 'desc')->paginate(20);
        
        return view('product.data', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::where('branch_id', session('branch_id'))->get();
        
        return view('product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        $product = new Product();
        $product->user_id = $request->user()->id;
        $product->branch_id = session('branch_id');
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().rand(0,1000);
            $image->storeAs($destination_path, $image_name);

            $product->image = $image_name;
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::where('branch_id', session('branch_id'))->get();
        
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        $product = Product::find($product->id);
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {

            if (Storage::exists('public/images/product/'.$product->image)) {
                Storage::delete('public/images/product/'.$product->image);
            }

            $destination_path = 'public/images/product';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().rand(0,1000);
            $image->storeAs($destination_path, $image_name);

            $product->image = $image_name;
        }

        $product->save();

        return redirect()->route('products')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products')->with('success', 'Product Deleted!');
    }
}
