<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['name','body','image'];

    public function tags(){

        return  $this->belongsToMany(Tag::class);
    }
}
