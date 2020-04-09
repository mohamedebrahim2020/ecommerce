<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['property'];

    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
