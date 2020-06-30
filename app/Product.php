<?php

namespace App;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = ['name','description','quantity','price','image','category_id','offer_id'];
//when we use create[] or object we must fill all fillable values
    public function category(){

        return  $this->belongsTo(Category::class);

    }

    public function orders(){

        return  $this->belongsToMany(Order::class);

    }

    public function reviews(){
        return $this->belongsToMany('App\User', 'reviews', 'product_id', 'user_id')->withPivot('body','rank', 'created_at');;
    }

   

    public function users(){
        return $this->belongsToMany('App\User', 'rates', 'product_id', 'user_id');
    }
    public function favourites(){
        return $this->belongsToMany('App\User', 'favourites', 'product_id', 'user_id');
    }
    public function checkInCart(){
        $checkExist = Cart::instance('main')->search(function ($cartItem, $rowId)  {
            return $cartItem->id === $this->id;
        });
        if ($checkExist->isNotEmpty()) {
            return 'remove';
        }
        else{
            return 'add to cart';
        }
    }

    public function checkHeart(){
        
        $authuser = Auth::id();
        $find= DB::table('favourites')->where([['product_id', '=', $this->id],['user_id','=',$authuser]])->get();
        
        if ($find->isNotEmpty()) {
        
            return 'red';
        }
        else{
            return 'grey';
        } 
    }

    public function checkWordHeart(){
        
        $authuser = Auth::id();
        $find= DB::table('favourites')->where([['product_id', '=', $this->id],['user_id','=',$authuser]])->get();
        
        if ($find->isNotEmpty()) {
        
            return 'remove from favourites';
        }
        else{
            return 'add to favourites';
        } 
    }

    public function offer(){

        return  $this->belongsTo(Offer::class);
    }

    public function finalPrice(){
        $x =   $this->offer->offer_percentage;
        $y =   $this->price;
        $z = $y - ($y * $x);
           return $z;
       }

       public function off_percent(){
        $x =   $this->offer->offer_percentage;
        $y= $x*100 ;
           return  $y;
       }

    // public function getRank(){
    //   $user_id = $this->users->user_id;
    //   $rank= DB::table('rates')->where([['product_id', '=', $this->id],['user_id','=',$user_id]])->get('rank');

    //    return $rank;
    // }


}
