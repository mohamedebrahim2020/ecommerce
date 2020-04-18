<?php

namespace App;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','quantity','price','image','rate'];

    public function category(){

        return  $this->belongsTo(Category::class);

    }

    public function orders(){

        return  $this->belongsToMany(Order::class);

    }

    public function properties(){

        return  $this->hasMany(Property::class);

    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function users(){
        return $this->belongsToMany('App\User', 'rates', 'product_id', 'user_id');
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





}
