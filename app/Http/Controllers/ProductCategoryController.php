<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    function __construct()
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
        $data = ProductCategory::where('branch_id', session('branch_id'))->with(['user'])->paginate(20);
        
        return view('product_category.data', [
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
        return view('product_category.create');
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
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $category = new ProductCategory();
        $category->user_id = $request->user()->id;
        $category->branch_id = session('branch_id');
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status == "on" ? 'active' : 'inactive';

        if ($request->hasFile('image')) {
            $destination_path = 'public/images/product_category';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().rand(0,1000);
            $image->storeAs($destination_path, $image_name);

            $category->image = $image_name;
        }
        
        $category->save();

        return redirect()->route('categories')->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $category)
    {
        return view('product_category.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        return view('product_category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $cat = ProductCategory::findOrFail($category->id);
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->status = $request->status == "on" ? 'active' : 'inactive';

        if ($request->hasFile('image')) {

            if (Storage::exists('public/images/product_category/'.$category->image)) {
                Storage::delete('public/images/product_category/'.$category->image);
            }

            $destination_path = 'public/images/product_category';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().rand(0,1000);
            $image->storeAs($destination_path, $image_name);

            $cat->image = $image_name;
        }

        $cat->save();

        return redirect()->route('categories')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted!');
    }
}
