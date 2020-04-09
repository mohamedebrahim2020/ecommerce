<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tags'];

    public function news(){
        return $this->belongsToMany('App\News', 'news_tag', 'tag_id', 'new_id');
    }
}
