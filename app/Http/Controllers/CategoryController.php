<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('admin.categories.list')->with(['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|file|mimes:jpg,png|max:12000',
        ]);

        $path = \Storage::disk('s3')->put('categories', $request->image);

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);
        // $path = \Storage::disk('s3')->url($path);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'file|mimes:jpg,png|max:12000',
        ]);

        if($request->has('image')){
            $path = \Storage::disk('s3')->put('categories', $request->image);
            $category->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path,
            ]);
        }else{
            $category->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        }

        return redirect()->route('categories.index');
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => true
        ]);
    }
}
