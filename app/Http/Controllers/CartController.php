<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function store($prodID) {
         // Cart::instance('main')->destroy();
        $product = Product::find($prodID);
        $checkExist = Cart::instance('main')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        if ($checkExist->isNotEmpty()) {
            //  Cart::instance('main')->destroy();
             //   dd($checkExist);
            foreach($checkExist as $check){
               $row = $check->rowId;
              
            }
            $remove = Cart::instance('main')->remove($row);
            $count=Cart::instance('main')->count();
             return response()->json($count);
            
        
           
        }
        $tax=Cart::setGlobalTax(0); 
        $item=Cart::instance('main')->add($product->id, $product->name, 1, $product->price)->associate('\App\Product');
        $count=Cart::instance('main')->count();
        // Cart::instance('main')->destroy();
        return response()->json($count);
         
        
         
    }

   
    public function test (){
        // dd(Cart::instance('main')->content());
     dd(Cart::instance('main')->count());
     }

     public function index (){
         $carts = Cart::instance('main')->content();
         return view('carts.cart',['carts'=>$carts]);
     }

     public function quantity(Request $request){
         $cartItem=Cart::instance('main')->update($request->rowNo,$request->qty);
         $carttotal=Cart::instance('main')->priceTotal();
         //dd($carttotal);
          return response()->json(["item"=>$cartItem,"total"=>$carttotal]);
     }

     public function remove (Request $request){
         $itemRemove = Cart::instance('main')->remove($request->row);
         $updatedTotal = Cart::instance('main')->priceTotal();
        //  dd($updatedTotal);
         return response()->json($updatedTotal);
     }

}
