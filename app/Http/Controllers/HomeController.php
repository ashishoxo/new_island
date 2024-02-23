<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        return view('home');
    }

    public function products($category_id)
    {
        $category = Category::with('products')->where('id',$category_id)->first();

        return view('products')->with(['category'=>$category]);
        
    }

    public function productDetails($product_id)
    {
        $product = Product::find($product_id);

        return view('product_details')->with(['product'=>$product]);
    }


    public function welcome()
    {
        if(auth()->user()){

            $this->syncCart();
        }
        return view('welcome');
    }
}
