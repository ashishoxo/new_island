<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function syncCart()
    {
        session_start();

        $session_products =  $_SESSION;

        // $db_products = [];

        // if(!empty(\Auth::user()->cartItems)){

        //     $db_products = array_column(\Auth::user()->cartItems->toArray(), 'product_id');
        // }
        // dd($session_products);
        if(isset($session_products['new_cart'])){
            foreach ($session_products['new_cart'] as $key => $session_product) {
                
                $cartItem = \Auth::user()->cartItems()->where([
                    'product_id' => $session_product['product_id'],
                    'size' => $session_product['size'],
                ])->first();

                if(!empty($cartItem)){

                    $cartItem->update(['quantity' => $session_product['quantity']]);

                }else{
                    $cartItem = CartItem::create([
                        'product_id' => $session_product['product_id'],
                        'size' => $session_product['size'],
                        'quantity' => $session_product['quantity']
                    ]);

                    \Auth::user()->cartItems()->attach([$cartItem->id]);
                }


                // if(in_array($session_product['product_id'], $db_products)){

                //     $cartItem = \Auth::user()->cartItems()->where([
                //         'product_id' => $session_product['product_id'],
                //         'size' => $session_product['size'],
                //     ])->first();

                //     if(!empty($cartItem)){

                //         $cartItem->update(['quantity' => $session_product['quantity']]);
                //     }
                //     // dd($cartItem);
                // }else{

                //     $cartItem = CartItem::create([
                //         'product_id' => $session_product['product_id'],
                //         'size' => $session_product['size'],
                //         'quantity' => $session_product['quantity']
                //     ]);

                //     \Auth::user()->cartItems()->attach([$cartItem->id]);
                // }

            }
        }
            
    }
}
