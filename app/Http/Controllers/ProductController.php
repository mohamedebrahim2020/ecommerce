<?php

namespace App\Http\Controllers;

use App\Category;
use App\Offer;
use App\Product;
use App\Review;
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
            //dd($request);
            $product = Product::find($request->product_id);
            $product->reviews()->detach($request->user_id);
            $product->reviews()->attach($request->user_id,['rank' =>$request->rating,'body'=>$request->review]);
            $avg = DB::table('reviews')->where('product_id','=',$request->product_id)->avg('rank');
            $product->average = (int)$avg;
            $product->save();
            return Redirect::back()->with('message', 'Your review has already recorded');

     }

    public function towards(Request $request){
        // dd($request);
       if ($request->best == 0) {
        $top = Product::orderBy('average','desc')->take(4)->get();
        
           return response()->json($top);
       }else{
           $category=Category::find($request->best);
        $cat= $category->products->sortByDesc('average')->take(4)->all();
        
        
        return response()->json($cat);
       }
    }
     

    public function show($product)
    {
        $prod = Product::find($product);
        $relates = $prod->category->products->where('id', '!=', $product);
        $reviews = $prod->reviews()->orderBy('rank','desc')->paginate(2);
        // $ff = Product::with('offer')->with('category')->paginate(2);

       
       
        
        //dd( $reviews->count());
       return view('products.show',['prod'=>$prod,'relates'=>$relates,'reviews'=>$reviews]);
    }

   
    public function checkCard(Product $product){
        return $product->checkInCart();
    }
    
    public function favourites (Request $request){
        $code =substr($request->seller, 0,1);
        $product_id= substr($request->seller,1);
        $seller = Product::find($product_id);
        $authuser = Auth::id();
        $find= DB::table('favourites')->where([['product_id', '=', $seller->id],['user_id','=',$authuser]])->get();
        if ($find->isNotEmpty()) {
            $seller->favourites()->detach($authuser);
            $seller->save();
            return response()->json(["color"=>"grey","id"=>$code.$seller->id,"text"=>"Add to favourites"]);
        }
        else{
            $seller->favourites()->attach($authuser,['created_at' => now()]);
            $seller->save();
            return response()->json(["color"=>"red","id"=>$code.$seller->id,"text"=>"Remove from favourites"]);
        } 
        
     
    }

    public function showFavourites ($id){
        $seller = Product::find($id);
        $authuser = Auth::id();
        $find= DB::table('favourites')->where([['product_id', '=', $seller->id],['user_id','=',$authuser]])->get();
        if ($find->isNotEmpty()) {
            $seller->favourites()->detach($authuser);
            $seller->save();
            return response()->json(["color"=>"grey","id"=>$id,"text"=>"Add to favourites"]);
        }
        else{
            $seller->favourites()->attach($authuser,['created_at' => now()]);
            $seller->save();
            return response()->json(["color"=>"red","id"=>$id,"text"=>"Remove from favourites"]);
        } 
        
     
    }

    public function price_offer(Product $product){
      return $product->finalPrice();
       }

    public function precent_offer(Product $product){
        return $product->off_percent();
        } 
    public function check_heart(Product $product){
            return $product->checkHeart();
            }
    public function text_heart(Product $product){
                return $product->checkWordHeart();
                }               

     public function indexOffer(){
       
      $products = Product::where('offer_id','>',1)->paginate(4);
      
      return view('offers',['products'=>$products]);
        
     }   

     public function index($category)
    {
        $products =Product::with('category')->where('category_id','=',$category)->paginate(4);
        $category = Category::find($category);
        return view('products.index', ['products' => $products,'selectedCategory'=>$category]);
    }



     //for admins

     public function indexproduct()
    {
        $products = Product::with('offer')->with('category')->paginate(2);
      //  dd($products);
        return view('layouts.AdminPanel.productsAdmin.index', [
            'products' => $products
        ]);
    }



    public function createProduct()
    {
        $offers = Offer::all();
        $categories = Category::all();
        return view('layouts.AdminPanel.productsAdmin.createproduct',[
            'offers' => $offers,
            'catetories' => $categories,
        ]);
    }
     public function addCategoryProductAdmin(Request $request)
    {
        //dd($request);
            $product = Product::create([
                'name' => $request->product,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'image' => $request->image->store('files','public'),
                'offer_id' => $request->offer_id,
                'category_id' => $request->category_id,

                
                
            ]);
        
            
            return redirect()->to('/admin/product')->with('message', 'Your product has already recorded');
    }


    public function editCategoryProductAdmin(Product $product){

        $offers = Offer::all();
        $categories = Category::all();
       
        
        return view('layouts.AdminPanel.productsAdmin.edit', [
            'categories' => $categories,
            'offers' => $offers,
            'product' => $product,
        ]);

    }

    public function updateCategoryProductAdmin(Request $request, Product $product){
      
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->image = $request->image->store('files','public');
        $product->offer_id = $request->input('offer_id');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('products.indexProduct')->with('message', 'product has already updated');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('products.indexProduct')->with('message', 'product has deleted successfully');
    }
}
