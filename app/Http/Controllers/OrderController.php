<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(\Auth::guard()->name == "admin"){

            $orders = Order::orderBy('created_at','desc')->get();
            // dd($orders);
            return view('admin.orders.list')->with(['orders'=>$orders]);
        }else{

            $orders = auth()->user()->orders()->orderBy('created_at','desc')->get();
            return view('orders')->with(['orders'=>$orders]);
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('admin.orders.show')->with(['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function placeOrder(Request $request)
    {
        // dd($request->all());
        // dd(\Auth::user()->cartItems);

        $addresses =  Address::where('id',$request->address_id)->first();

        $order = \Auth::user()->orders()->create([
            "status" => "ordered",
            "is_available" => 1,
            "delivery_address" => $addresses->line1.", ".$addresses->line2.", ".$addresses->city.", ".$addresses->state.", ".$addresses->country.", ".$addresses->line2.", ".$addresses->zip,
            "phone_no" => \Auth::user()->phone_no, 
        ]); 

        $cart_items = \Auth::user()->cartItems->toArray();

        unset($cart_items['id']);
        unset($cart_items['created_at']);
        unset($cart_items['updated_at']);
        unset($cart_items['pivot']);
        
        $order->orderItems()->createMany($cart_items);

        \Auth::user()->cartItems()->detach();
        unset($_SESSION['new_cart']);
        \Session::flash('order_placed', 'This is a message!'); 
        return new JsonResponse([], 200);
    }
}
