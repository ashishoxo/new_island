<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        
    }

    protected function syncCart()
    {
        

        $session_products =  $_SESSION;

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

            }
        }
            
    }


}
