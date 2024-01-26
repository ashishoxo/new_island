<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('admin.products.list')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add')->with(['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|file|mimes:jpg,png|max:12000',
        ]);

        $path = \Storage::disk('s3')->put('products', $request->image);

        $product = Product::create([
            "category_id" => $request->category,
            "name" => $request->name,
            "description" => $request->description,
            "image" => $path,
            "is_available" => 1
        ]);

        // dd($request->all());

        $product->varients()->createMany($request->varient);

        return redirect()->route('products.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit')->with(['product'=>$product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'file|mimes:jpg,png|max:12000',
        ]);

        if($request->has('image')){
            $path = \Storage::disk('s3')->put('products', $request->image);

            $product->update([
                "category_id" => $request->category,
                "name" => $request->name,
                "description" => $request->description,
                "image" => $path,
                "is_available" => 1
            ]);
        }else{
            $product->update([
                "category_id" => $request->category,
                "name" => $request->name,
                "description" => $request->description
            ]);
        }

        $product->varients()->delete();        

        $product->varients()->createMany($request->varient);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => true
        ]);
    }
}
