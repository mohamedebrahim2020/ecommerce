<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function store($prodID) {

        $product = Product::find($prodID);
        
           
         $zz=Cart::search(function($cartItem,$rowID) use($prodID){
               return $cartItem->id === $prodID; 
            });
         
            if (empty($zz)) {
                $tax=Cart::setGlobalTax(0);
                $cartItem= Cart::instance('main')->add($product->id,$product->name, 1,$product->price, $product->weight,['image' => $product->image]);

            }
            
        //  Cart::instance('main')->destroy();
    }

   
    public function test (){
        dd(Cart::instance('main')->content());
     }

}
