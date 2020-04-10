<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function storerank(Request $request){
       $product = Product::find($request->id);
    //    dd($product);
       $authuser = Auth::id();
       $product->users()->attach($request->rate,['user_id'=> $authuser , 'product_id' => $request->id,'rank' =>$request->rate]);
    
       $avg = DB::table('rates')->where('product_id', $request->id)->avg('rank');
       $addtotable= DB::table('products')
       ->where('id', $request->id)
       ->update(['average' => $avg-1]);
       dd($avg-1);
    }

    public function towards($category){
       if ($category == "0") {
          return $this->best();
       }else{
           $category= Category::find($category);
           return $this->bests($category);
       }
    }
    public function best(){
       $top = Product::orderBy('average','desc')->take(4)->get();
       dd($top);

    }

    public function bests($category){
        
        $cat= $category->products->sortByDesc('average')->take(2)->all();
          dd($cat);
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
}
