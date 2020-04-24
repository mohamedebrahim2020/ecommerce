<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function storerank(Request $request){
        $product = Product::find($request->id);
        //    dd($product);
           $authuser = Auth::id();
            $product->users()->detach($authuser);
           $product->users()->attach($authuser,['rank' =>$request->rate]);
            $avg = DB::table('rates')->where('product_id','=',$request->id)->avg('rank');
            $product->average = $avg;
            $product->save();

     }

    public function towards($category){
       if ($category == "5") {
        $top = Product::orderBy('average','desc')->take(4)->get();
        //    dd($top);
           return response()->json($top);
       }else{
           $category=Category::find($category);
        $cat= $category->products->sortByDesc('average')->take(4);
        dd($cat);
        
        return response()->json($cat);
       }
    }
     


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $prod = Product::find($product);
        // dd($prod);
       return view('products.show',['prod'=>$prod]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function checkCard(Product $product){
        return $product->checkInCart();
    }
    
    public function favourites (Product $seller){
        // dd($seller);
        $authuser = Auth::id();
        $find= DB::table('favourites')->where([['product_id', '=', $seller->id],['user_id','=',$authuser]])->get();
        // dd($find);
        if ($find->isNotEmpty()) {
            $seller->favourites()->detach($authuser);
            $seller->save();
            return response()->json(["color"=>"grey","id"=>$seller->id]);
        }
        else{
            $seller->favourites()->attach($authuser,['created_at' => now()]);
            $seller->save();
            return response()->json(["color"=>"red","id"=>$seller->id]);
        } 
        
     
    }

    // public function heartCheck(Product $product){
    //     return $product->checkInCart();
    // }
}
