<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $tops = Product::orderBy('average','desc')->take(4)->get();
        $prods= DB::table('order_product')->select('product_id',DB::raw('SUM(quantity) as total_qty'))
       ->groupBy('product_id')->orderBy('quantity','DESC')->get()->take(4);
        $arrs=[];
        foreach($prods as $prod){
        array_push($arrs,
            $product=Product::find($prod->product_id)
        );
    }
           return  view('home',['tops'=> $tops,'arrs'=> $arrs]);
    }
}
