<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
     public function store($prodID) {
         
        $product = Product::find($prodID);
       $z= $product->finalPrice();
       
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
            $lists=Cart::instance('main')->content();
            $prices=Cart::instance('main')->priceTotal();
             return response()->json(["count"=>$count,"status"=>"add to cart","lists"=> $lists, "prices"=>$prices]);
            
        
           
        }
       
        $tax=Cart::setGlobalTax(0); 
        $item=Cart::instance('main')->add($product->id, $product->name, 1, $z)->associate('\App\Product');
        $count=Cart::instance('main')->count();
        $lists=Cart::instance('main')->content();
        $prices=Cart::instance('main')->priceTotal();
        // Cart::instance('main')->destroy();
        return response()->json(["count"=>$count,"status"=>"remove","lists"=> $lists, "prices"=>$prices]);
         
        
         
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
         $storeQuantity=Product::where('id','=', $request->itemPriceId)->value('quantity');
        //  dd($storeQuantity);
        if ($request->qty <= $storeQuantity) {
          $cartItem=Cart::instance('main')->update($request->rowNo,$request->qty);
          $carttotal=Cart::instance('main')->priceTotal();
         //dd($carttotal);
           return response()->json(["item"=>$cartItem,"total"=>$carttotal]);
        }else{
                $messages="more";
                return response()->json(["storeQuantity"=>$storeQuantity,"messages"=>$messages]);
        }
        
     }

     public function remove (Request $request){
         $itemRemove = Cart::instance('main')->remove($request->row);
         $updatedTotal = Cart::instance('main')->priceTotal();
        //  dd($updatedTotal);
         return response()->json($updatedTotal);
     }

}
