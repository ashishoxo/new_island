<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(empty(\Auth::user())){
            

            $session_products =  $_SESSION; 

            if(isset($session_products['new_cart'])){

                $products = $session_products['new_cart'];
            }else{
                $products = [];
            }
            // dd($session_products);
        }else{
            $products = \Auth::user()->cartItems->toArray();
        }

        return view('cart')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(\Auth::user());
        // if(empty(\Auth::user())){

        

        $session_products =  $_SESSION;   
                 
        $is_already_exist = false;
        
        if(isset($session_products['new_cart'])){

            foreach ($session_products['new_cart'] as $key => $product) {
                // dump(1);
                if($product['product_id'] == $request->product_id && $product['size'] == $request->size){
                    // dump(2);
                    $session_products['new_cart'][$key]['quantity'] = $request->quantity;
                    
                    $is_already_exist = true;                    
                }
            }
        
        }
        
        if(!$is_already_exist){

            
            $session_products['new_cart'][] = [
                'product_id' => $request->product_id,
                'size' => $request->size,
                'quantity' => $request->quantity
            ];
            
        }

        $_SESSION['new_cart'] = $session_products['new_cart'];

        if(!empty(\Auth::user())){

            $cartItems = \Auth::user()->cartItems;

            
            $is_already_exist_auth = false;

            if(!empty($cartItems)){
 
                foreach ($cartItems as $key => $cartItem) {

                    if($cartItem->product_id == $request->product_id && $cartItem->size == $request->size){

                        CartItem::where([
                            'product_id' => $request->product_id,
                            'size' => $request->size
                        ])->update([
                            'quantity' => $request->quantity
                        ]);

                        $is_already_exist_auth = true;  
                    }
                }   

            }      

            if(!$is_already_exist_auth){
                $cartItem = CartItem::create([
                    'product_id' => $request->product_id,
                    'size' => $request->size,
                    'quantity' => $request->quantity
                ]);

                \Auth::user()->cartItems()->attach([$cartItem->id]);
            }
                
        }

        return new JsonResponse(["status"=>"success","message"=>"✔ Product has been added to the cart.","count"=>count($_SESSION['new_cart'])], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        //
    }
}
