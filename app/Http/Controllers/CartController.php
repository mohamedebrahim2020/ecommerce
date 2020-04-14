<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function store($prodID) {
        $product = Product::find($prodID);
        
            $cart= Cart::instance('main')->add($product->id,$product->name, 1,$product->price, $product->weight);
           
               dd(Cart::instance('main')->content());
        
    }

}
