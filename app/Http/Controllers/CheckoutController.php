<?php

namespace App\Http\Controllers;

use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index (){
        $carts = Cart::instance('main')->content();
        
         return view('carts.checkout',['carts'=>$carts]);
    }

    public function discount($voucher){
        
        $percentage = DB::table('discounts')->where('code','=', $voucher)->value('precentage');
        if ($percentage == null) {
            return response()->json("error");
        }else{
         $total =Cart::instance('main')->priceTotal();
         $afterDiscount = (($total)-($total * $percentage));
        //  dd($percentage);
        session()->put('discount', $afterDiscount);
          return response()->json($afterDiscount);
        }
    } 

    public function store(Request $request)
    {
        $this->validate($request, [
            'email_address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            // 'Appartement' => 'required',
            'zip_code' => 'required',
            'shipping_method' => 'required',

        ]);
        DB::transaction(function () use ($request) {
            
            $order = new Order();
            $order->contact_email = $request->input('email_address');
            $order->first_name = $request->input('first_name');
            $order->last_name = $request->input('last_name');
            $order->shipping_address = $request->input('address');
            $order->country = $request->input('country');
            $order->city = $request->input('city');
            $order->appartment = $request->input('Appartement');
            $order->post_code = $request->input('zip_code');
            $order->shipping_method = $request->input('shipping_method');
            $order->created_at = now();
            if (session()->has('discount')) {
                $order->total_price = session()->get('discount');
            }else{
            $order->total_price = Cart::instance('main')->priceTotal();
            }
            $order->user_id = auth()->user()->id;
            $order->save();

            $carts=Cart::instance('main')->content();
            
            foreach ($carts as $cart) {
              DB::table("order_product")->insert([
                
                'product_id' => $cart->id,
                'quantity' => $cart->qty,
                'order_id' => $order->id,
                'created_at' => now(),
              ]);
              $oldQty = DB::table('products')->where('id','=', $cart->id)->value('quantity');
              
              $newQty = $oldQty-($cart->qty);
            //   dd($newQty);
              DB::table('products')->where('id','=', $cart->id)->update(['quantity' => $newQty]);
            }

            Cart::instance('main')->destroy();

        },1);
        return redirect()->to('/home')->with('message', 'Your order has already recorded');
    }
}
