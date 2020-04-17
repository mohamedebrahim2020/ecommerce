<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index (){
        $carts = Cart::instance('main')->content();
        
         return view('carts.checkout',['carts'=>$carts]);
    }
}
