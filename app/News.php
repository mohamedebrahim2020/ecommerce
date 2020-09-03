<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['name', 'body', 'image', 'created_at'];

    public function tags()
    {

        return $this->belongsToMany('App\Tag', 'new_tag', 'new_id', 'tag_id');
    }
}
