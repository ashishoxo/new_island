<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        $totalSummary = $this->totalSummary($request);

        $addresses = \Auth::user()->addresses;

        return view('cart')->with(['products'=>$products,'total_summary'=>$totalSummary,'addresses'=>$addresses]);
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

                        $cartItem->update([
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


    public function deleteItem(Request $request)
    {
        if(\Auth::user()){

            \Auth::user()->cartItems()->detach(\Auth::user()->cartItems()->where(["product_id"=>$request->product_id,"size"=>$request->size])->first()->id);
        }

        $session_products =  $_SESSION;   
        
        if(isset($session_products['new_cart'])){

            foreach ($session_products['new_cart'] as $key => $product) {
                // dump(1);
                if($product['product_id'] == $request->product_id && $product['size'] == $request->size){
                    // dump(2);
                    unset($session_products['new_cart'][$key]);
                                        
                }
            }
        
        }

        $_SESSION['new_cart'] = $session_products['new_cart'];

        return new JsonResponse(["status"=>"success","message"=>"Product has been removed from the cart.","count"=>count($_SESSION['new_cart'])], 200);
        
            
    }

    public function totalSummary(Request $request)
    {
        $cartCount = 0;
        $totalAmount = 0; 

        if(\Auth::user()){

            $cartItems = \Auth::user()->cartItems;

            $cartCount = $cartItems->count();

            foreach ($cartItems as $key => $item) {
                
                $product = Product::find($item->product_id);
                
                $unitPrice = $product->varients()->where('size',$item->size)->first()->price;

                $totalAmount += ($unitPrice * $item->quantity);
            }

        }else{

            $session_products =  $_SESSION;   

            if(isset($session_products['new_cart'])){

                $cartCount = count($session_products['new_cart']);
                foreach ($session_products['new_cart'] as $key => $item) {
                    // dump(1);

                    $product = Product::find($item['product_id']);
                
                    $unitPrice = $product->varients()->where('size',$item['size'])->first()->price;

                    $totalAmount += ($unitPrice * $item['quantity']);
                }
            
            }
        }

        $result =  [
            'count' => $cartCount,
            'amount' => $totalAmount
        ];

        if($request->wantsJson()){

            return new JsonResponse($result, 200);
        }else{
            return $result;
        }
        
        
    }
}
