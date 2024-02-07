<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        dd(\Auth::user()->cartItems);

        foreach (\Auth::user()->cartItems as $key => $item) {
            
            // \Auth::user()->order()->create([
            //     ""
            // ]);            
        }
        \Auth::user()->cartItems()->detach();
        unset($_SESSION['new_cart']);
        \Session::flash('order_placed', 'This is a message!'); 
        return new JsonResponse([], 200);
    }
}
