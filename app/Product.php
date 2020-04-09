<?php

namespace App;

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
        return $this->belongsToMany(User::class);
    }




}
