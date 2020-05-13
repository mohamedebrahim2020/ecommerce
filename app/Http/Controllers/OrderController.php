<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function myOrders($id){
      // $orders =Order::with('products')->where('user_id','=',$id)->get()->pluck('products')->collapse()->pluck('category'); //pluck return object of product model instead of order model
      // dd($orders);
       $orders =Order::with('products')->where('user_id','=',$id)->paginate(1);
       return view('myorders',['orders'=>$orders]);
       return redirect()->to('/myorders');


     }
}
